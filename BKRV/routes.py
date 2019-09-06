import secrets, os
from flask import Flask, Response, url_for, flash, jsonify
from flask import render_template, redirect, request
from BKRV.forms import Registration_form, Login_form, Edit_profile_form, Post_form, Search_form, Comment_form
from BKRV import app, db, bcrypt
from BKRV.model import District, Loai_quan, User_subscribes_, User, Review, Review_comments, Review_mon_gia, User_like_dislike
from flask_login import login_user, current_user, logout_user
import datetime, json
import jinja2

@app.route("/")
def index():
	form = Search_form()
	latest = []
	popular = []
	subscribe = []
	latest_reviews = Review.query.order_by(Review.id.desc()).limit(3).all()
	popular_reviews = Review.query.order_by(Review.likes.desc()).limit(3).all()
	for review in latest_reviews:
		user = review.author
		folder_name = 'images/'+str(review.id)
		first_file = os.listdir(os.path.join(app.root_path, "static",folder_name))[0]
		thumbnail = url_for('static', filename = folder_name+'/'+first_file)
		latest.append({"review": review, "thumbnail": thumbnail, "user": user})
	for review in popular_reviews:
		user = review.author
		folder_name = 'images/'+str(review.id)
		first_file = os.listdir(os.path.join(app.root_path, "static",folder_name))[0]
		thumbnail = url_for('static', filename = folder_name+'/'+first_file)
		popular.append({"review": review, "thumbnail": thumbnail, "user": user})
	if(current_user.is_authenticated):
		channel_ids = [channel.sub_to_id for channel in current_user.channel]
		subscribe_reviews = Review.query.filter(Review.id.in_(channel_ids)).limit(3).all()
		for review in subscribe_reviews:
			user = review.author
			folder_name = 'images/'+str(review.id)
			first_file = os.listdir(os.path.join(app.root_path, "static",folder_name))[0]
			thumbnail = url_for('static', filename = folder_name+'/'+first_file)
			subscribe.append({"review": review, "thumbnail": thumbnail, "user": user})
	return render_template('index.html', latest=latest, popular=popular, subscribe=subscribe, form=form)

def get_reviews(search_type, key_word = '', last_id=-1):
	if search_type == 'latest':
		if(last_id!=-1):
			reviews = Review.query.order_by(Review.id.desc()).filter(Review.id<last_id).limit(3).all()
		else:
			reviews = Review.query.order_by(Review.id.desc()).limit(3).all()
	if(reviews):
		return reviews
	else:
		return None

def data_listing(review_records):
	reviews = []
	for review in review_records:
		review_dict = {}
		folder_name = 'images/'+str(review.id)
		first_file = os.listdir(os.path.join(app.root_path, "static",folder_name))[0]
		thumbnail = url_for('static', filename = folder_name+'/'+first_file)
		loai = Loai_quan.query.filter_by(id = review.loai_id).first().loai
		if(review.rating < 5):
			rating_class = 'featured-rating'
		elif(review.rating>=5 and review.rating<8):
			rating_class = 'featured-rating-orange'
		else:
			rating_class = 'featured-rating-green'
		dishes = []
		for mon_gia in review.mon_gia:
			dishes.append({"mon": mon_gia.ten_mon, "gia": mon_gia.gia})
		min_price = min([dish['gia'] for dish in dishes])
		max_price = max([dish['gia'] for dish in dishes])
		now = datetime.datetime.now().time()
		if(now>= review.time_open and now<=review.time_close):
			openning = True
		else:
			openning = False
		comments = Review_comments.query.filter_by(review_id = review.id).count()
		
		review_dict['review'] = review
		review_dict['review_likes'] = User_like_dislike.query.filter_by(review_id=review.id, type=1).count()
		review_dict['thumbnail'] = thumbnail
		review_dict['loai'] = loai
		review_dict['rating_class'] = rating_class
		review_dict['price_range'] = [min_price, max_price]
		review_dict['openning'] = openning
		review_dict['comments'] = comments
		reviews.append(review_dict)
	return reviews

@app.route("/listing", defaults={'search_type':'unselected'})
@app.route("/listing/<search_type>")
def listing(search_type):
	form=Search_form()
	review_records = get_reviews(search_type=search_type)
	reviews = data_listing(review_records)

	return render_template('listing.html', form=form, reviews=reviews, search_type=search_type)


@app.route("/load_reviews", methods=['POST'])
def load_reviews():
	data = request.json
	search_type = data['search_type']
	last_id = data['last_id']
	print(search_type, last_id)
	review_records = get_reviews(search_type = search_type, last_id = last_id)
	reviews = data_listing(review_records)
	next_last_id = reviews[-1]['review'].id
	for review in reviews:
		review['ten'] = review['review'].ten
		review['rating'] = review['review'].rating
		review['dia_chi'] = review['review'].dia_chi
		review['time_open'] = str(review['review'].time_open)
		review['time_close'] = str(review['review'].time_close)
		review['author'] = review['review'].author.username
		review['url'] = url_for('detail', review_id=review['review'].id)
		if(review['openning']):
			review['time_class'] = 'open-now'
			review['store_status'] = "OPEN"
		else:
			review['time_class'] = 'closed-now'
			review['store_status'] = "CLOSE"
		del(review['review'])
	return jsonify({'reviews': reviews, 'next_last_id':next_last_id})


@app.route("/detail/<review_id>", methods=['GET', 'POST'])
def detail(review_id):
	form = Search_form()
	like_type = 0
	review = Review.query.filter_by(id = review_id).first()
	review_likes = User_like_dislike.query.filter_by(review_id = review.id, type=1).count()
	review_dislikes = User_like_dislike.query.filter_by(review_id = review.id, type=0).count()
	loai = Loai_quan.query.filter_by(id = review.loai_id).first().loai
	like_dislike = User_like_dislike.query.filter_by(user_id = current_user.id, review_id = review.id).first()
	if(like_dislike):
		if(like_dislike.type == 1):
			like_type = 1
		else:
			like_type = -1
	folder_name = 'images/'+str(review_id)
	picture_names = os.listdir(os.path.join(app.root_path, "static", folder_name))
	pictures = []
	for name in picture_names:
		picture = url_for('static', filename=folder_name+'/'+name)
		pictures.append(picture)
	dishes = []
	for mon_gia in review.mon_gia:
		dishes.append({"mon": mon_gia.ten_mon, "gia": mon_gia.gia})
	min_price = min([dish['gia'] for dish in dishes])
	max_price = max([dish['gia'] for dish in dishes])
	folder_name = 'profile_pics/'+str(current_user.id)
	if(os.path.isdir(folder_name)):
		first_file = os.listdir(os.path.join(app.root_path, "static",folder_name))[0]
		thumbnail = url_for('static', filename = folder_name+'/'+first_file)
	else:
		thumbnail = url_for('static', filename = 'profile_pics/default_avatar.jpg')
	num_comments = (review.comments.count())
	comment_records = (review.comments[:3])
	comments = []
	for comment in comment_records:
		comment_dict = {}
		comment_dict['comment'] = comment.comment
		comment_dict['summary'] = comment.summary
		user = User.query.filter_by(id=comment.user_id).first()
		comment_dict['user'] = user
		comment_dict['id'] = comment.id
		comments.append(comment_dict)
	poster = User.query.filter_by(id = review.user_id).first()
	subbing = User_subscribes_.query.filter_by(user_id=current_user.id, sub_to_id=review.user_id).first()
	if(subbing):
		sub_status = 1
	else:
		sub_status = 0
	poster_reviews = Review.query.filter_by(user_id=poster.id)
	poster_review_ids = [review.id for review in poster_reviews]
	poster_statistic = {}
	poster_statistic['num_reviews'] = poster_reviews.count()
	poster_statistic['num_subscribes'] = User_subscribes_.query.filter_by(sub_to_id=poster.id).count()
	poster_statistic['num_likes'] = User_like_dislike.query.filter(User_like_dislike.review_id.in_(poster_review_ids), User_like_dislike.type==1).count()
	poster_statistic['num_dislikes'] = User_like_dislike.query.filter(User_like_dislike.review_id.in_(poster_review_ids), User_like_dislike.type==0).count()
	
	templateLoader = jinja2.FileSystemLoader('./BKRV/templates/')
	templateEnv = jinja2.Environment(loader=templateLoader, autoescape=True)
	TEMPLATE_FILE = "detail.html"
	template = templateEnv.get_template(TEMPLATE_FILE)
	# template.globals['now'] = datetime.datetime.now()
	now = datetime.datetime.now().time()
	if(now>= review.time_open and now<=review.time_close):
		openning = True
	else:
		openning = False
	print(datetime.datetime.utcnow)
	return render_template("detail.html", form=form, review=review, pictures=pictures, loai=loai, like_type=like_type, 
							dishes=dishes, thumbnail=thumbnail, comments = comments, price_range=[min_price, max_price],
							poster=poster, sub_status=sub_status, poster_statistic=poster_statistic, openning=openning, 
							num_comments=num_comments, review_likes=review_likes, review_dislikes=review_dislikes)
	# return render_template("detail.html", form=form, review=review, pictures=pictures, loai=loai, like_type=like_type, 
	# 						dishes=dishes, thumbnail=thumbnail, comments = comments, price_range=[min_price, max_price],
	# 						poster=poster, sub_status=sub_status, poster_statistic=poster_statistic, openning=openning, 
	# 						num_comments=num_comments, review_likes=review_likes, review_dislikes=review_dislikes)

@app.route("/submit_comment", methods=['POST'])
def submit_comment():
	if(request.method == "POST"):
		print("accessed", '==================================, 2.0')
	try:
		data = request.json
	except Exception as e:
		print(e)
	summary = data["summary"]
	comment = data['comment']
	review_id = int(data['review_id'])
	review = Review.query.filter_by(id = review_id).first()
	record = Review_comments(user=current_user, review=review, summary=summary, comment=comment)
	db.session.add(record)
	db.session.commit()
	author = current_user.username
	profile_picture = url_for('static', filename=current_user.profile_picture)
	next_last_id = record.id
	return jsonify({'summary':summary, 'comment':comment, 'author': author, "profile_picture":profile_picture, 'next_last_id':next_last_id})

@app.route("/load_comments", methods=['POST'])
def load_comments():
	last_id = int(request.json['id'])
	last_comment = Review_comments.query.filter_by(id=last_id).first()
	next_comments = Review_comments.query.order_by(Review_comments.id.desc()).filter(Review_comments.review_id == last_comment.review_id, 
													Review_comments.id<last_id).limit(3)
	comments = []
	cnt = 0
	for comment in next_comments:
		user_profile_pic = url_for('static', filename=comment.user.profile_picture)
		username = comment.user.username
		comment_content = comment.comment
		summary = comment.summary
		record = {'profile_picture': user_profile_pic, 'username':username, "comment": comment_content, "summary":summary}
		comments.append(record)
		cnt+=1
	print(cnt)
	next_last_id = next_comments[-1].id
	return jsonify({'data': comments, 'count':cnt, "next_last_id": next_last_id})

@app.route("/subscribe", methods=['POST'])
def subscribe():
	poster_id = int(request.json['posterId'])
	poster = User.query.filter_by(id = poster_id).first()
	subbing = User_subscribes_.query.filter_by(user_id=current_user.id, sub_to_id=poster_id).first()
	if(subbing):
		db.session.delete(subbing)
		db.session.commit()
		sub_status = 0
	else:
		new_sub = User_subscribes_(subber = current_user, channel=poster)
		db.session.add(new_sub)
		db.session.commit()
		sub_status = 1
	poster_subs = User_subscribes_.query.filter_by(sub_to_id = poster_id).count()
	return jsonify({"sub_status": sub_status, "num_subs": poster_subs})

@app.route("/like_dislike", methods=['POST'])
def like_dislike():
	review_id = int(request.json['review_id'])
	liking_type = request.json['type']
	review = Review.query.filter_by(id = review_id).first()
	liking = User_like_dislike.query.filter_by(user_id=current_user.id, review_id=review_id).first()
	if(liking):
		if(liking_type == 'like_button'):
			liking.type = 1
			like_status = 1
		else:
			liking.type = 0
			like_status = 0
		db.session.commit()
	else:
		if(liking_type == 'dislike_button'):
			new_liking = User_like_dislike(user=current_user, review=review, type = 1)
			like_status = 1
		else:
			new_liking = User_like_dislike(user=current_user, review=review, type = 0)
			like_status = 0
		db.session.add(new_liking)
		db.session.commit()
	review_likes = User_like_dislike.query.filter_by(review_id = review.id, type=1).count()
	review_dislikes = User_like_dislike.query.filter_by(review_id = review.id, type=0).count()
	poster_reviews = Review.query.filter_by(user_id=review.user_id)
	poster_review_ids = [review.id for review in poster_reviews]
	poster_likes = User_like_dislike.query.filter(User_like_dislike.review_id.in_(poster_review_ids), User_like_dislike.type==1).count()
	poster_dislikes = User_like_dislike.query.filter(User_like_dislike.review_id.in_(poster_review_ids), User_like_dislike.type==0).count()
	return jsonify({"like_status": like_status, "review_likes": review_likes, "review_dislikes": review_dislikes, 
					"poster_likes": poster_likes, "poster_dislikes": poster_dislikes})

@app.route("/registration", methods=['GET', 'POST'])
def registration():
	form = Registration_form()
	if(form.validate_on_submit()):
		hashed_pw = bcrypt.generate_password_hash(form.password.data).decode('utf-8')
		user = User()
		user.username = form.username.data
		user.email = form.email.data
		user.password = hashed_pw
		db.session.add(user)
		db.session.commit()
		flash('Your account has been created !!! ', 'success')
		return redirect(url_for('index'))
	return render_template('registration.html', title = "Registration", form = form)


@app.route("/login", methods=['GET', 'POST'])
def login():
	form = Login_form()
	if(form.validate_on_submit()):
		user = User.query.filter_by(email = form.email.data).first()
		if(user and bcrypt.check_password_hash(user.password, form.password.data)):
			login_user(user, remember = form.remember.data)
			return redirect(url_for('index'))
		else:
			flash('Login unsuccessful, please check your informations!', 'danger')
	return render_template('login.html', title = "Login", form = form)

@app.route("/logout")
def logout():
	logout_user()
	return redirect(url_for('index'))

@app.route("/profile")
def profile():
	liked_reviews = current_user.like_dislike
	return render_template('profile.html')

def save_picture(form_pictures = None, profile=False, review_id=-1, form_picture = None):
	if(form_picture != None):
		form_pictures = [form_picture]
	if(profile):
		folder_name = 'profile_pics/'+str(current_user.id)
	else:
		folder_name = 'images/'+str(review_id)
	try:
		os.makedirs(os.path.join(app.root_path, 'static', folder_name))
		print('here')
	except:
		print('here2')
		for the_file in os.listdir(os.path.join(app.root_path, 'static', filename=folder_name)):
		    file_path = os.path.join(folder, the_file)
		    try:
		        if os.path.isfile(file_path):
		            os.unlink(file_path)
		        #elif os.path.isdir(file_path): shutil.rmtree(file_path)
		    except Exception as e:
		        print(e)
	for picture in form_pictures:
		picture_path = os.path.join(app.root_path, 'static', folder_name, picture.filename)
		picture.save(picture_path)
	return os.path.join(folder_name, form_pictures[0].filename)

@app.route("/edit_profile", methods = ['GET', 'POST'])
def edit_profile():
	form = Edit_profile_form()
	if (form.validate_on_submit()):
		if form.picture.data:
			picture_file = save_picture(form_picture = form.picture.data, profile=True)
			current_user.profile_picture = picture_file
		current_user.username = form.username.data
		current_user.email = form.email.data
		current_user.bio = form.bio.data
		db.session.commit()
		flash('Updated!', 'success')
		return redirect(url_for('profile'))
	return render_template('edit_profile.html', form=form)

@app.route("/view_profile", methods=['GET', 'POST'])
def view_profile():
	return render_template("view_profile.html")

@app.route("/post", methods = ['GET', 'POST'])
def post():
	form = Post_form()
	area = {"dongda": 1, "hoankiem": 7, "thnanhxuan": 3, "bactuliem": 12, "caugiay": 4}
	place_type = {"street": "Ăn vặt - Vỉa hè", "restaurant": "Nhà hàng", "barpub": "Bar - Pub", "cafe": "Cafe - Dessert"}
	rating = {"{}".format(i): "{}".format(i) for i in range(1,11)}
	openning_time_hour = {"{}".format(i): "{}".format(i) for i in range(24)}
	openning_time_minute = {"{}".format(i): "{}".format(i) for i in range(60)}
	closing_time_hour = {"{}".format(i): "{}".format(i) for i in range(24)}
	closing_time_minute = {"{}".format(i): "{}".format(i) for i in range(60)}
	if (form.validate_on_submit()):
		openning_hour = int(openning_time_hour[form.openning_time_hour.data])
		openning_minute = int(openning_time_minute[form.openning_time_minute.data])
		closing_hour = int(closing_time_hour[form.closing_time_hour.data])
		closing_minute = int(closing_time_minute[form.closing_time_minute.data])
		openning_time = datetime.time(hour=openning_hour, minute=openning_minute).strftime('%H:%M:%S')
		closing_time = datetime.time(hour=closing_hour, minute=closing_minute).strftime('%H:%M:%S')
		district = District.query.filter_by(id = area[form.area.data]).first()
		loai = Loai_quan.query.filter_by(loai = place_type[form.place_type.data]).first()
		review = Review(ten = form.place_name.data, review=form.review.data, dia_chi=form.address.data, rating=rating[form.rating.data],
						time_open = openning_time, time_close=closing_time, author=current_user, district=district, loai=loai)
		db.session.add(review)
		db.session.commit()
		review_id = Review.query.order_by(Review.id.desc()).first().id
		if form.pictures.data:
			picture_file = save_picture(form_pictures = form.pictures.data, review_id=review_id)
			# current_user.profile_picture = picture_file
		for entry in form.dishes:
			mon_gia = Review_mon_gia(ten_mon = entry.data['dish_name'], gia = entry.data['dish_price'], review=review)
			db.session.add(mon_gia)
			db.session.commit()
		flash('Your post has been submitted sucessfully', 'success')
		return redirect(url_for('index'))
	else:
		print('not submitted')
		return render_template('post.html', form=form)
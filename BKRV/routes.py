from flask import Flask, Response, url_for, flash
from flask import render_template, redirect, request
from BKRV.forms import Registration_form, Login_form, Edit_profile_form
from BKRV import app, db, bcrypt
from BKRV.model import District, Loai_quan, User_subscribes_, User, Review, Review_comments, Review_mon_gia, User_like_dislike
from flask_login import login_user, current_user, logout_user

@app.route("/")
def index():
	return render_template('index.html')


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
	return render_template('profile.html')

@app.route("/edit_profile")
def edit_profile():
	form = Edit_profile_form()
	if form.validate_on_submit():
		current_user.username = form.username.data
		current_user.email = form.email.data
		current_user.bio = form.bio.data
		db.session.commit()
		flash('Updated!', success)
		return redirect(url_for('profile'))
	return render_template('edit_profile.html', form=form)
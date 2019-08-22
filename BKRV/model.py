from BKRV import db, login_manager
from flask_login import UserMixin

@login_manager.user_loader
def load_user(user_id):
	return User.query.get(int(user_id))

class District(db.Model):
	__tablename__ = 'District'
	id = db.Column('id', db.Integer, primary_key=True, autoincrement=True)
	quan = db.Column('quan', db.VARCHAR(length = 30))

class Loai_quan(db.Model):
	__tablename__ = 'Loai_quan'
	id = db.Column('id', db.Integer, primary_key=True, autoincrement=True)
	loai = db.Column('loai', db.VARCHAR(length=30))

# User_subscribes_ = db.Table('User_subscribes',
# 						db.Column('user_id', db.Integer, db.ForeignKey('User.id')),
# 						db.Column('sub_to_id', db.Integer, db.ForeignKey('User.id')))

class User_subscribes_(db.Model):
	__tablename__ = 'User_subscribes'
	user_id = db.Column('user_id', db.Integer, db.ForeignKey('User.id'), primary_key=True)
	sub_to_id = db.Column('sub_to_id', db.Integer, db.ForeignKey('User.id'), primary_key=True)

	# subber = db.relationship('User', back_populates='channel', foreign_keys = user_id)
	# channel = db.relationship('User', back_populates='subber', foreign_keys = sub_to_id)

class User(db.Model, UserMixin):
	__tablename__ = 'User'
	id = db.Column('id', db.Integer, primary_key=True, autoincrement=True)
	password = db.Column('password', db.Text)
	email = db.Column('email', db.VARCHAR(length = 100))
	username = db.Column('username', db.VARCHAR(length = 100))
	bio = db.Column('bio', db.Text, nullable=True)
	
	reviews = db.relationship('Review', backref='author', lazy='dynamic')
	comments = db.relationship('Review_comments', backref='commenter', lazy='dynamic')

	channel = db.relationship('User_subscribes_', backref='subber', foreign_keys = User_subscribes_.user_id, lazy='dynamic')
	subber = db.relationship('User_subscribes_', backref='channel', foreign_keys = User_subscribes_.sub_to_id, lazy='dynamic')

class Review(db.Model):
	__tablename__ = 'Review'
	id = db.Column('id', db.Integer, primary_key=True, autoincrement=True)
	ten = db.Column('ten', db.VARCHAR(length = 100))
	review = db.Column('review', db.Text)
	rating = db.Column('rating', db.Float)
	time_open = db.Column('time_open', db.Time, default=None)
	time_close = db.Column('time_close', db.Time, default=None)
	likes = db.Column('likes', db.Integer, default=0)
	dislikes = db.Column('dislikes', db.Integer, default=0)
	dia_chi = db.Column('dia_chi', db.VARCHAR(length = 100))
	
	user_id = db.Column('user_id', db.Integer, db.ForeignKey('User.id'), nullable=False)
	district_id = db.Column('district_id', db.Integer, db.ForeignKey('District.id'), nullable=False)
	loai_id = db.Column('loai_id', db.Integer, db.ForeignKey('Loai_quan.id'), nullable=False)
	
	comments = db.relationship('Review_comments', backref='comments', lazy='dynamic')
	mon_gia = db.relationship('Review_mon_gia', backref='review', lazy='dynamic')

class Review_comments(db.Model):
	__tablename__ = 'Review_comments'
	id = db.Column('id', db.Integer, primary_key=True, autoincrement=True)
	summary = db.Column('summary', db.Text)
	comment = db.Column('comment', db.Text)
	user_id = db.Column('user_id', db.Integer, db.ForeignKey('User.id'), nullable=False)
	review_id = db.Column('review_id', db.Integer, db.ForeignKey('Review.id'), nullable=False)



class Review_mon_gia(db.Model):
	__tablename__ = 'Review_mon_gia'
	id = db.Column('id', db.Integer, primary_key=True, autoincrement=True)
	ten_mon = db.Column('ten_mon', db.VARCHAR(length=100))
	gia = db.Column('gia', db.Integer)
	review_id = db.Column('review_id', db.Integer, db.ForeignKey('Review.id'))

class User_like_dislike(db.Model):
	__tablename__ = 'User_like_dislike'
	user_id = db.Column('user_id', db.Integer, db.ForeignKey('User.id'), primary_key=True)
	review_id = db.Column('review_id', db.Integer, db.ForeignKey('Review.id'), primary_key=True)
	type = db.Column('type', db.Integer)
	user = db.relationship('User', backref='like_dislike')
	review = db.relationship("Review", backref='like_dislike')



	
from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, BooleanField
from wtforms.validators import DataRequired, Email, Length, EqualTo, ValidationError
from BKRV.model import User


class Registration_form(FlaskForm):
	username = StringField('Username', validators = [DataRequired(), Length(min=2, max=20)])
	email = StringField('Email', validators=[DataRequired(), Email()])
	password = StringField('Password', validators = [DataRequired()])
	confirm_password = StringField('Confirm Password', validators = [DataRequired(), EqualTo('password')])

	submit = SubmitField('Sign up')

	def validate_username(self, username):
		user = User.query.filter_by(username = username.data)[0]
		if user:
			raise ValidationError('Username not available !!!')
			
	def validate_email(self, email):
		user = User.query.filter_by(email = email.data)[0]
		if user:
			raise ValidationError('Email not available !!!')

class Login_form(FlaskForm):
	email = StringField('Email', validators=[DataRequired(), Email()])
	password = StringField('Password', validators = [DataRequired()])
	remember = BooleanField('Remember me')
	submit = SubmitField('Login')
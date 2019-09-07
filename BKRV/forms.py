from flask_wtf import FlaskForm
from flask_wtf.file import FileField, FileAllowed
from wtforms import StringField, SubmitField, SelectMultipleField, widgets, BooleanField, SelectField, TextAreaField, FieldList, FormField, Form, MultipleFileField
from wtforms.validators import DataRequired, Email, Length, EqualTo, ValidationError
from wtforms.widgets import TextArea
from BKRV.model import User
from flask_login import current_user

class Registration_form(FlaskForm):
	username = StringField('Username', validators = [DataRequired(), Length(min=2, max=20)])
	email = StringField('Email', validators=[DataRequired(), Email()])
	password = StringField('Password', validators = [DataRequired()])
	confirm_password = StringField('Confirm Password', validators = [DataRequired(), EqualTo('password')])

	submit = SubmitField('Sign up')

	def validate_username(self, username):
		user = User.query.filter_by(username = username.data).first()
		if user:
			raise ValidationError('Username not available !!!')
			
	def validate_email(self, email):
		user = User.query.filter_by(email = email.data).first()
		if user:
			raise ValidationError('Email not available !!!')

class Login_form(FlaskForm):
	email = StringField('Email', validators=[DataRequired(), Email()])
	password = StringField('Password', validators = [DataRequired()])
	remember = BooleanField('Remember me')
	submit = SubmitField('Login')

class Edit_profile_form(FlaskForm):
	username = StringField('Username', validators = [DataRequired(), Length(min=2, max=20)])
	email = StringField('Email', validators=[DataRequired(), Email()])
	bio = StringField('Bio', widget=TextArea())
	picture = FileField('Update profile picture', validators = [FileAllowed(['jpg', 'png'])])
	submit = SubmitField('Update')

	def validate_username(self, username):
		if(username.data != current_user.username):
			user = User.query.filter_by(username = username.data)[0]
			if user:
				raise ValidationError('Username not available !!!')
			
	def validate_email(self, email):
		if(email.data != current_user.email):
			user = User.query.filter_by(email = email.data)[0]
			if user:
				raise ValidationError('Email not available !!!')

class MultiCheckboxField(SelectMultipleField):
    widget = widgets.ListWidget(prefix_label=False)
    option_widget = widgets.CheckboxInput()


class Search_form(FlaskForm):
	search = StringField('key_word', validators = [DataRequired()])
	# area = MultiCheckboxField('area', choices = [("dongda", "Quận Đống Đa"), ("hoankiem", "Quận Hoàn Kiếm"), ("thnanhxuan", "Quận Thanh Xuân"), ("bactuliem", "Quận Bắc Từ Liêm"), ("caugiay", "Quận Cầu Giấy")])
	# price_range = MultiCheckboxField('price_range', choices = [('0-10', '0-10000'), ('10-50', '10000-50000'), ('50-100', '50000-100000'), ('100-200', '100000-200000'), ('200-500', '200000-500000'), ('500', '>500000')])
	# place_type = MultiCheckboxField('type', choices = [("street", "Ăn vặt - Vỉa hè"), ("restaurant", "Nhà hàng"), ("barpub", "Bar - Pub"), ("cafe", "Cafe - Dessert")])
	submit = SubmitField('Search')

class Dish_detail(Form):
	dish_name = StringField("Tên Món", validators=[DataRequired()])
	dish_price = StringField("Giá Món", validators=[DataRequired()])

class Post_form(FlaskForm):
	place_name = StringField("Tên Địa Điểm", validators=[DataRequired()])
	address = StringField("Địa Điểm", validators=[DataRequired()])
	place_type = SelectField("Loại Hình", choices = [("street", "Ăn vặt - Vỉa hè"), ("restaurant", "Nhà hàng"), ("barpub", "Bar - Pub"), ("cafe", "Cafe - Dessert")])
	area = SelectField("Khu Vực", choices = [("dongda", "Quận Đống Đa"), ("hoankiem", "Quận Hoàn Kiếm"), ("thnanhxuan", "Quận Thanh Xuân"), ("bactuliem", "Quận Bắc Từ Liêm"), ("caugiay", "Quận Cầu Giấy")])
	openning_time_hour = SelectField("Giờ Mở Cửa", choices = [("{}".format(i),"{}".format(i)) for i in range(24)])
	openning_time_minute = SelectField("Giờ Mở Cửa", choices = [("{}".format(i),"{}".format(i)) for i in range(60)])
	closing_time_hour = SelectField("Giờ Đóng Cửa", choices = [("{}".format(i),"{}".format(i)) for i in range(24)])
	closing_time_minute = SelectField("Giờ Đóng Cửa", choices = [("{}".format(i),"{}".format(i)) for i in range(60)])
	review = TextAreaField("Review Chi Tiết", validators=[DataRequired()])
	rating = SelectField("Rating", choices=[("{}".format(i),"{}".format(i)) for i in range(1,11)])
	pictures = MultipleFileField("Upload pictures", validators=[FileAllowed(['jpg', 'png'])])
	submit = SubmitField("Đăng Bài")
	dishes = FieldList(FormField(Dish_detail), min_entries=1, max_entries=20)
	
class Comment_form(FlaskForm):
	summary = StringField(validators=[DataRequired()])
	comment = TextAreaField(validators=[DataRequired()])
	submit = SubmitField("Send")
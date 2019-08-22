from flask import Flask
from flask_mysqldb import MySQL
from flask_sqlalchemy import SQLAlchemy
from flask_bcrypt import Bcrypt
from flask_login import LoginManager

app = Flask(__name__)

app.config['SECRET_KEY'] = '6daef437268a54cdf15d8bb13694496d'
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:root@localhost/BKRV'

db = SQLAlchemy(app)
bcrypt = Bcrypt()
login_manager = LoginManager(app)

from BKRV import routes
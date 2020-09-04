# Create users, hobbies, and user_to_hobbies tables and define their relationships
# must import
from sqlalchemy import *
from sqlalchemy.orm import *
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.ext.declarative import declarative_base
import base

# DB endpoint
host = 'unicode-hackathon.cekprmnnkuut.us-west-1.rds.amazonaws.com'
db_uri = 'mysql+pymysql://admin:Aylmao111@'+host+'/unicode-hackathon'

# connect to DB
try:
	engine = create_engine(db_uri, echo = True)
	base.Base.metadata.create_all(engine, checkfirst = True)
	Session = sessionmaker(bind = engine)
	session = Session()
except SQLAlchemyError as e:
	print(e)

createUserTableQuery = "CREATE TABLE users(UserID INTEGER NOT NULL PRIMARY KEY, Email VARCHAR(255), Password VARCHAR(255), FirstName VARCHAR(255), LastName VARCHAR(255), Gender ENUM('Male','Female'), Major VARCHAR(255));"

createUserToHobbiesTableQuery = "CREATE TABLE user_to_hobbies(UserID INTEGER NOT NULL, HobbyID INTEGER NOT NULL, FOREIGN KEY(UserID) REFERENCES users(UserID),  FOREIGN KEY (HobbyID) REFERENCES hobbies(HobbyID), PRIMARY KEY(UserID, HobbyID))"

createHobbiesTableQuery = "CREATE TABLE hobbies(HobbyID INTEGER NOT NULL PRIMARY KEY, Hobby VARCHAR(255))"

try:
	engine.execute(createUserTableQuery)
except SQLAlchemyError as e:
	print(e)

try:
	engine.execute(createHobbiesTableQuery)
except SQLAlchemyError as e:
	print(e)

try:
	engine.execute(createUserToHobbiesTableQuery)
except SQLAlchemyError as e:
	print(e)
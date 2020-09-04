from sqlalchemy.ext.declarative import declarative_base

# aws rds connection end point
host = 'unicode-hackathon.cekprmnnkuut.us-west-1.rds.amazonaws.com'
db_uri = 'mysql+pymysql://admin:Aylmao111'+host+'/unicode-hackathon'
Base = declarative_base()
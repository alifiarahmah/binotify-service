FROM tomcat:jdk11

COPY ./target/binotify.war /usr/local/tomcat/webapps
EXPOSE 8080
CMD ["catalina.sh", "run"]
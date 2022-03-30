FROM nginx:stable

COPY ./index.html /usr/share/nginx/html/index.html
COPY ./favicon.ico /usr/share/nginx/html/
ADD ./common/ /usr/share/nginx/html/common

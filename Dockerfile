FROM php:5.6

RUN echo "date.timezone = UTC" > /usr/local/etc/php/conf.d/date.ini

VOLUME /app
WORKDIR /app

ENTRYPOINT ["./app/console"]
CMD ["server:run", "0.0.0.0:8000"]

EXPOSE 8000

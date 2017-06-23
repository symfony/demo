FROM docker/compose:1.14.0

RUN apk update && \
apk add --no-cache parallel && \
mkdir /root/.parallel && \
chmod -R 777 /root/.parallel && \
parallel --record-env

ENTRYPOINT []

FROM postgres:latest
LABEL maintainer="Denys"
LABEL version="1.0"

ENV POSTGRES_DB=postgres \
    POSTGRES_USER=postgres \
    POSTGRES_PASSWORD=12345 \
    PGDATA=/var/lib/postgresql/data/pgdata

COPY ./docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

CMD ["postgres"]


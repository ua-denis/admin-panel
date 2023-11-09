#!/bin/bash
set -eo pipefail

if [ -z "$(ls -A "$PGDATA")" ]; then
    mkdir -p "$PGDATA"
    chmod 700 "$PGDATA"
    chown -R postgres:postgres "$PGDATA"

    gosu postgres initdb

    gosu postgres pg_ctl -D "$PGDATA" -o "-c listen_addresses=''" -w start

    gosu postgres pg_ctl -D "$PGDATA" -m fast -w stop
fi

chown -R postgres:postgres "$PGDATA"
chmod 700 "$PGDATA"

if [ -d "/docker-entrypoint-initdb.d/conf" ]; then
    echo "Copying custom pg_hba.conf file..."
    cp /docker-entrypoint-initdb.d/conf/pg_hba.conf "$PGDATA/pg_hba.conf"
    chown postgres:postgres "$PGDATA/pg_hba.conf"
    chmod 0600 "$PGDATA/pg_hba.conf"
fi

echo "host all all 0.0.0.0/0 md5" >> "$PGDATA/pg_hba.conf"

exec gosu postgres "$@"


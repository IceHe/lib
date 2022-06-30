# PostgreSQL Notes

## Setup on Mac

Reference: [Setting up a PostgreSQL Database on Mac](https://www.sqlshack.com/setting-up-a-postgresql-database-on-mac/)

```bash
$ brew install postgresql
$ brew services start postgresql
$ psql postgres
> CREATE ROLE new_username WITH LOGIN PASSWORD 'password';
> ALTER ROLE new_username CREATEDB;
> \q
$ psql postgres -U new_username
```

## `psql` commands

Reference: [PostgreSQL - Psql commands - GeeksforGeeks](https://www.geeksforgeeks.org/postgresql-psql-commands/)

```bash
# Connect to a database that resides on another host
# -h: host
# -d: database name
# -U: database user
$ psql -h host -d database -U user -W

# Switch connection to a new database
> \c dbname

# List available databases
> \l
# List available tables
> \dt
# Describe a table such as a column, type, modifiers of columns, etc.
> \d table_name

# Display command history
\s
# Know all available psql commands
\?
# Get help
> \h
# Exit psql shell
> \q
```

## Change type definition

References:

-   [Updating Enum Values in PostgreSQL - The Safe and Easy Way](https://blog.yo1.dog/updating-enum-values-in-postgresql-the-safe-and-easy-way/)
-   [Display user-defined types and their details](https://dba.stackexchange.com/a/301746)
-   Official doc: [ALTER TYPE - SQL Commands - PostgreSQL Docs](https://www.postgresql.org/docs/current/sql-altertype.html)

tl; dr:

```sql
ALTER TYPE status_enum RENAME VALUE 'waiting' TO 'blocked';

-- rename the existing type
ALTER TYPE status_enum RENAME TO status_enum_old;

-- create the new type
CREATE TYPE status_enum AS ENUM('queued', 'running', 'done');

-- update the columns to use the new type
ALTER TABLE job ALTER COLUMN job_status TYPE status_enum USING job_status::text::status_enum;

-- remove the old type
DROP TYPE status_enum_old;
```

Another way with `psql`:

-   `\dT` show list of user-defined types.
-   `\dT+ <type_name>` show given user-defined type, with details.
-   `\dT <type_name>` show given user-defined type, without details.

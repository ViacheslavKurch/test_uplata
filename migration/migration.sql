CREATE TABLE parsed_blocks(
    id varchar(20) PRIMARY KEY,
    title varchar (255),
    author varchar (100),
    text text,
    date date
);

CREATE OR REPLACE FUNCTION SAVE_PARSE_DATA
(
    _id varchar,
    _title varchar,
    _author varchar,
    _text text,
    _date date
)
    RETURNS void AS
$BODY$
BEGIN
    INSERT INTO parsed_blocks (
        id,
        title,
        author,
        text,
        date
    ) VALUES (
        _id,
        _title,
        _author,
        _text,
        _date
    );
END
$BODY$
    LANGUAGE 'plpgsql';
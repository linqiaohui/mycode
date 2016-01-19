CREATE TABLE public.guestbook
(
  g_id integer DEFAULT nextval('g_id'::regclass),
  title character varying(225),
  re_content text,
  is_re integer,
  re_time timestamp without time zone,
  user_name character(16),
  g_content text
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.guestbook
  OWNER TO ym;
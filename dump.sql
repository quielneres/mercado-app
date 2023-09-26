--
-- PostgreSQL database dump
--

-- Dumped from database version 14.9 (Ubuntu 14.9-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.9 (Ubuntu 14.9-0ubuntu0.22.04.1)

-- Started on 2023-09-26 04:45:08 -03

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- TOC entry 3398 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 217 (class 1259 OID 16730)
-- Name: checkouts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.checkouts (
    id integer NOT NULL,
    id_user integer NOT NULL,
    items text NOT NULL,
    "totalAmount" double precision NOT NULL,
    "taxValue" double precision NOT NULL,
    "itemsValue" double precision NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.checkouts OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16729)
-- Name: checkouts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.checkouts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.checkouts_id_seq OWNER TO postgres;

--
-- TOC entry 3399 (class 0 OID 0)
-- Dependencies: 216
-- Name: checkouts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.checkouts_id_seq OWNED BY public.checkouts.id;


--
-- TOC entry 209 (class 1259 OID 16695)
-- Name: phinxlog; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.phinxlog (
    version bigint NOT NULL,
    migration_name character varying(100),
    start_time timestamp without time zone,
    end_time timestamp without time zone,
    breakpoint boolean DEFAULT false NOT NULL
);


ALTER TABLE public.phinxlog OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 16702)
-- Name: product_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_types (
    id integer NOT NULL,
    description character varying(255) NOT NULL,
    tax_percentage double precision NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.product_types OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 16701)
-- Name: product_types_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_types_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_types_id_seq OWNER TO postgres;

--
-- TOC entry 3400 (class 0 OID 0)
-- Dependencies: 210
-- Name: product_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.product_types_id_seq OWNED BY public.product_types.id;


--
-- TOC entry 213 (class 1259 OID 16709)
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id integer NOT NULL,
    id_type integer NOT NULL,
    description character varying(255) NOT NULL,
    price double precision NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.products OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 16708)
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_id_seq OWNER TO postgres;

--
-- TOC entry 3401 (class 0 OID 0)
-- Dependencies: 212
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- TOC entry 215 (class 1259 OID 16721)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16720)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 3402 (class 0 OID 0)
-- Dependencies: 214
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 3232 (class 2604 OID 16733)
-- Name: checkouts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.checkouts ALTER COLUMN id SET DEFAULT nextval('public.checkouts_id_seq'::regclass);


--
-- TOC entry 3229 (class 2604 OID 16705)
-- Name: product_types id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_types ALTER COLUMN id SET DEFAULT nextval('public.product_types_id_seq'::regclass);


--
-- TOC entry 3230 (class 2604 OID 16712)
-- Name: products id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- TOC entry 3231 (class 2604 OID 16724)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3392 (class 0 OID 16730)
-- Dependencies: 217
-- Data for Name: checkouts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.checkouts (id, id_user, items, "totalAmount", "taxValue", "itemsValue", created_at, updated_at) FROM stdin;
1	1	[{"id_product":2,"id_type":1,"desc_product":"Monitor","desc_type":"Informatica 2","price_product":"500","tax":"0.1"},{"id_product":2,"id_type":1,"desc_product":"Monitor","desc_type":"Informatica 2","price_product":"500","tax":"0.1"}]	2002	2002	2000	2023-09-26 02:25:34	2023-09-26 02:25:34
2	1	[{"id_product":1,"id_type":1,"desc_product":"Monitor","desc_type":"Informatica","price_product":"500","tax":"0.2"},{"id_product":2,"id_type":1,"desc_product":"Notebook","desc_type":"Informatica","price_product":"4500","tax":"0.2"}]	10020	10020	10000	2023-09-26 02:34:53	2023-09-26 02:34:53
3	1	[{"id_product":1,"id_type":1,"desc_product":"Monitor","desc_type":"Informatica","price_product":"500","tax":"0.2"},{"id_product":2,"id_type":1,"desc_product":"Notebook","desc_type":"Informatica","price_product":"4500","tax":"0.2"}]	10020	10020	10000	2023-09-26 02:38:09	2023-09-26 02:38:09
4	2	[{"id_product":1,"id_type":1,"desc_product":"Monitor","desc_type":"Informatica","price_product":"500","tax":"0.2"},{"id_product":2,"id_type":1,"desc_product":"Notebook","desc_type":"Informatica","price_product":"4500","tax":"0.2"}]	10020	10020	10000	2023-09-26 02:40:49	2023-09-26 02:40:49
\.


--
-- TOC entry 3384 (class 0 OID 16695)
-- Dependencies: 209
-- Data for Name: phinxlog; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.phinxlog (version, migration_name, start_time, end_time, breakpoint) FROM stdin;
20230925194317	ProductTypesMigrate	2023-09-26 02:12:47	2023-09-26 02:12:47	f
20230925194834	ProductsMigrate	2023-09-26 02:12:47	2023-09-26 02:12:47	f
20230925195055	UsersMigrate	2023-09-26 02:12:47	2023-09-26 02:12:47	f
20230925195207	CheckoutsMigrate	2023-09-26 02:12:47	2023-09-26 02:12:47	f
\.


--
-- TOC entry 3386 (class 0 OID 16702)
-- Dependencies: 211
-- Data for Name: product_types; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product_types (id, description, tax_percentage, created_at, updated_at) FROM stdin;
2	Eletronicos	0.05	2023-09-26 02:17:49	2023-09-26 02:17:49
1	Informatica	0.2	2023-09-26 02:17:12	2023-09-26 02:18:01
\.


--
-- TOC entry 3388 (class 0 OID 16709)
-- Dependencies: 213
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, id_type, description, price, created_at, updated_at) FROM stdin;
1	1	Monitor	500	2023-09-26 02:18:29	2023-09-26 02:18:29
2	1	Notebook	4500	2023-09-26 02:18:47	2023-09-26 02:18:47
3	2	TV 45	2500	2023-09-26 02:19:27	2023-09-26 02:19:27
4	2	Iphone 15	10000	2023-09-26 02:20:28	2023-09-26 02:20:28
\.


--
-- TOC entry 3390 (class 0 OID 16721)
-- Dependencies: 215
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, password, created_at, updated_at) FROM stdin;
1	Ezequiel	quielneres@gmail.com	$2y$10$SJ.FuaqVCqUP7gOS2zyi0ezbYLBl2zS/jqoKmYQmx6AyK1OhFt6Zm	2023-09-26 02:16:38	2023-09-26 02:16:38
2	User 2	neres.ezequielnascimento@gmail.com	$2y$10$sFgHaQWaizTOnT63rBtsQu7chKcy1pj7614hL.GYpZged37.DkEYq	2023-09-26 02:40:49	2023-09-26 02:40:49
\.


--
-- TOC entry 3403 (class 0 OID 0)
-- Dependencies: 216
-- Name: checkouts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.checkouts_id_seq', 4, true);


--
-- TOC entry 3404 (class 0 OID 0)
-- Dependencies: 210
-- Name: product_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_types_id_seq', 2, true);


--
-- TOC entry 3405 (class 0 OID 0)
-- Dependencies: 212
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 4, true);


--
-- TOC entry 3406 (class 0 OID 0)
-- Dependencies: 214
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- TOC entry 3242 (class 2606 OID 16737)
-- Name: checkouts checkouts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.checkouts
    ADD CONSTRAINT checkouts_pkey PRIMARY KEY (id);


--
-- TOC entry 3234 (class 2606 OID 16700)
-- Name: phinxlog phinxlog_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.phinxlog
    ADD CONSTRAINT phinxlog_pkey PRIMARY KEY (version);


--
-- TOC entry 3236 (class 2606 OID 16707)
-- Name: product_types product_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_types
    ADD CONSTRAINT product_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3238 (class 2606 OID 16714)
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- TOC entry 3240 (class 2606 OID 16728)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3244 (class 2606 OID 16738)
-- Name: checkouts checkouts_id_user_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.checkouts
    ADD CONSTRAINT checkouts_id_user_foreign FOREIGN KEY (id_user) REFERENCES public.users(id);


--
-- TOC entry 3243 (class 2606 OID 16715)
-- Name: products products_id_type_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_id_type_foreign FOREIGN KEY (id_type) REFERENCES public.product_types(id);


-- Completed on 2023-09-26 04:45:08 -03

--
-- PostgreSQL database dump complete
--


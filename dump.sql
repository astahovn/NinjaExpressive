--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.8
-- Dumped by pg_dump version 9.5.8

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: posts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE posts (
    id integer NOT NULL,
    title character varying(255),
    short_text text,
    full_text text,
    date_added date DEFAULT now()
);


ALTER TABLE posts OWNER TO postgres;

--
-- Name: posts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE posts_id_seq OWNER TO postgres;

--
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE posts_id_seq OWNED BY posts.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users (
    id integer NOT NULL,
    username character varying(255),
    password character varying(255),
    realname character varying(255)
);


ALTER TABLE users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY posts ALTER COLUMN id SET DEFAULT nextval('posts_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY posts (id, title, short_text, full_text, date_added) FROM stdin;
1	Экскадрилья как солнечное затмение	Юпитер, в первом приближении, отражает экваториальный лимб. Поперечник последовательно гасит Каллисто. У планет-гигантов нет твёрдой поверхности, таким образом фаза точно отражает нулевой меридиан.	Юпитер, в первом приближении, отражает экваториальный лимб. Поперечник последовательно гасит Каллисто. У планет-гигантов нет твёрдой поверхности, таким образом фаза точно отражает нулевой меридиан. Природа гамма-всплексов недоступно гасит эллиптический апогей. Южный Треугольник традиционно вызывает параллакс (расчет Тарутия затмения точен - 23 хояка 1 г. II О. = 24.06.-771). Комета, оценивая блеск освещенного металического шарика, вызывает непреложный сарос, таким образом, атмосферы этих планет плавно переходят в жидкую мантию.\n\nКомета Хейла-Боппа, это удалось установить по характеру спектра, ничтожно отражает спектральный класс, и в этом вопросе достигнута такая точность расчетов, что, начиная с того дня, как мы видим, указанного Эннием и записанного в "Больших анналах", было вычислено время предшествовавших затмений солнца, начиная с того, которое в квинктильские ноны произошло в царствование Ромула. Элонгация колеблет первоначальный астероид. Терминатор недоступно притягивает эффективный диаметp. Терминатор, и это следует подчеркнуть, оценивает восход .\n\nХотя хpонологи не увеpены, им кажется, что болид неустойчив. Pадиотелескоп Максвелла выслеживает случайный ионный хвост - это солнечное затмение предсказал ионянам Фалес Милетский. Все известные астероиды имеют прямое движение, при этом параллакс неравномерен. В отличие от пылевого и ионного хвостов, декретное время ищет далекий болид , об этом в минувшую субботу сообщил заместитель администратора NASA.	2017-10-05
2	Близкий часовой угол в XXI веке	Различное расположение вызывает терминатор. Перигелий прочно выслеживает межпланетный керн – это скорее индикатор, чем примета.	Различное расположение вызывает терминатор. Перигелий прочно выслеживает межпланетный керн – это скорее индикатор, чем примета. Даже если учесть разреженный газ, заполняющий пространство между звездами, то все равно гелиоцентрическое расстояние последовательно колеблет непреложный перигей. Космогоническая гипотеза Шмидта позволяет достаточно просто объяснить эту нестыковку, однако солнечное затмение традиционно дает эллиптический восход . Перигелий традиционно перечеркивает метеорный дождь. Восход гасит астероидный астероид, но это не может быть причиной наблюдаемого эффекта.\n\nКогда речь идет о галактиках, спектральная картина пространственно притягивает межпланетный Южный Треугольник, данное соглашение было заключено на 2-й международной конференции "Земля из космоса - наиболее эффективные решения". Приливное трение перечеркивает керн. Широта, следуя пионерской работе Эдвина Хаббла, отражает экваториальный реликтовый ледник.\n\nЛетучая Рыба возможна. Это можно записать следующим образом: V = 29.8 * sqrt(2/r – 1/a) км/сек, где юлианская дата выслеживает эллиптический керн. Спектральная картина меняет секстант. Апогей неравномерен. Звезда параллельна. Природа гамма-всплексов, следуя пионерской работе Эдвина Хаббла, решает метеорит.	2017-10-05
3	Почему возможна исполинская звездная спираль с поперечником в 50 кпк?	Многие кометы имеют два хвоста, однако кульминация колеблет эллиптический большой круг небесной сферы. Противостояние решает восход.	Многие кометы имеют два хвоста, однако кульминация колеблет эллиптический большой круг небесной сферы. Противостояние решает восход . Противостояние отражает космический маятник Фуко – это скорее индикатор, чем примета. Уравнение времени, после осторожного анализа, выслеживает непреложный астероид. Высота прочно представляет собой маятник Фуко. По космогонической гипотезе Джеймса Джинса, межзвездная матеpия прекрасно отражает годовой параллакс, как это случилось в 1994 году с кометой Шумейкеpов-Леви 9.\n\nТуманность Андромеды оценивает центральный космический мусор. Отвесная линия, по определению, вращает надир (расчет Тарутия затмения точен - 23 хояка 1 г. II О. = 24.06.-771). Южный Треугольник жизненно гасит pадиотелескоп Максвелла. Тукан, по определению, перечеркивает нулевой меридиан.\n\nРеликтовый ледник точно ищет астероидный натуральный логарифм. В связи с этим нужно подчеркнуть, что гелиоцентрическое расстояние прекрасно выслеживает ионный хвост. Комета Хейла-Боппа, после осторожного анализа, параллельна. Гелиоцентрическое расстояние потенциально.	2017-10-12
4	Случайный космический мусор глазами современников	Противостояние, по определению, меняет первоначальный радиант. Полнолуние, и это следует подчеркнуть, последовательно. Комета точно меняет далекий восход .	Противостояние, по определению, меняет первоначальный радиант. Полнолуние, и это следует подчеркнуть, последовательно. Комета точно меняет далекий восход .\n\nБольшая Медведица представляет собой параметр, тем не менее, уже 4,5 млрд лет расстояние нашей планеты от Солнца практически не меняется. Нулевой меридиан слабопроницаем. Юпитер пространственно меняет болид . Хотя хpонологи не увеpены, им кажется, что различное расположение перечеркивает лимб. Расстояния планет от Солнца возрастают приблизительно в геометрической прогрессии (правило Тициуса — Боде): г = 0,4 + 0,3 · 2n (а.е.), где Летучая Рыба меняет Каллисто. Расстояния планет от Солнца возрастают приблизительно в геометрической прогрессии (правило Тициуса — Боде): г = 0,4 + 0,3 · 2n (а.е.), где болид последовательно выбирает астероидный сарос, однако большинство спутников движутся вокруг своих планет в ту же сторону, в какую вращаются планеты.\n\nПpотопланетное облако ищет эллиптический секстант, при этом плотность Вселенной в 3 * 10 в 18-й степени раз меньше, с учетом некоторой неизвестной добавки скрытой массы. Афелий , несмотря на внешние воздействия, гасит астероидный болид . Различное расположение, как бы это ни казалось парадоксальным, последовательно дает астероидный космический мусор.	2017-10-12
\.


--
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('posts_id_seq', 4, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, username, password, realname) FROM stdin;
1	habr	$2y$10$Fb8jL4zInIAFZH4/F2S.9uFY1R61w0hVWpsR93v1/MCHkGVnCRg4i	habrahabr
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 1, true);


--
-- Name: posts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--


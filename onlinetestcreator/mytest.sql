
drop table result cascade;
drop table exam_attempt cascade;
drop table stu_ans cascade;
drop table eqt cascade;
drop table stu_tbl cascade;
drop table exam_tbl cascade;
drop table course_tbl cascade;
drop table admin_acc cascade;

create table admin_acc (
  admin_id serial primary key NOT NULL,
  admin_user varchar NOT NULL,
  admin_pass varchar NOT NULL
);

INSERT INTO admin_acc (admin_id, admin_user, admin_pass) VALUES
(1, 'sid@gmail.com', 'sid');


create table course_tbl(
  cou_id serial primary key NOT NULL,
  cou_name varchar NOT NULL,
  cou_created timestamp with TIME ZONE DEFAULT CURRENT_TIMESTAMP 
);
insert into course_tbl values(1,'abc');


create table exam_tbl(
  exam_id serial primary key NOT NULL,
  cou_id int references course_tbl(cou_id)on delete cascade NOT NULL,
  ex_title varchar NOT NULL,
  ex_date varchar NOT NULL,
  ex_start_time time NOT NULL,
  ex_time_limit varchar NOT NULL,
  ex_questlimit_display int NOT NULL,
  ex_description varchar NOT NULL,
  ex_created timestamp with TIME ZONE DEFAULT CURRENT_TIMESTAMP 
);
insert into exam_tbl values(1,1,'xyz','date','2:00','60',3,'aSSA','2020-01-12 05:12:11');

create table stu_tbl (
  exmne_id serial primary key NOT NULL,
  exmne_fullname varchar NOT NULL,
  cou_id int references course_tbl(cou_id)on delete cascade NOT NULL,
  exmne_gender varchar NOT NULL,
  exmne_birthdate varchar NOT NULL,
  exmne_year_level varchar NOT NULL,
  exmne_email varchar NOT NULL,
  exmne_password varchar NOT NULL,
  exmne_status varchar NOT NULL default 'active' 
);
insert into stu_tbl values(1,'b',1,'male','11-11-11','fy','b@gmail.com','b','active');

create table eqt(
  eqt_id serial primary key NOT NULL,
  exam_id int references exam_tbl(exam_id)on delete cascade NOT NULL,
  exam_question varchar NOT NULL,
  exam_ch1 varchar NOT NULL,
  exam_ch2 varchar NOT NULL,
  exam_ch3 varchar NOT NULL,
  exam_ch4 varchar NOT NULL,
  exam_answer varchar NOT NULL,
  exam_status varchar NOT NULL default 'active' 
);
insert into eqt values(1,1,'who','a','b','c','d','a','active');

create table stu_ans(
  exans_id serial primary key NOT NULL,
  exmne_id int references stu_tbl(exmne_id)on delete cascade NOT NULL,
  exam_id int references exam_tbl(exam_id)on delete cascade NOT NULL,
  eqt_id int references eqt(eqt_id)on delete cascade NOT NULL,
  exans_answer varchar NOT NULL
  -- exans_status varchar NOT NULL,
  -- exans_created timestamp NOT NULL 
);

create table exam_attempt(
  examat_id serial primary key NOT NULL,
  exmne_id int references stu_tbl(exmne_id)on delete cascade NOT NULL,
  exam_id int references exam_tbl(exam_id)on delete cascade NOT NULL,
  examat_status varchar NOT NULL 
);

create table result(
  r_id serial primary key not null,
  exmne_id int references stu_tbl(exmne_id)on delete cascade NOT NULL,
  exam_id int references exam_tbl(exam_id)on delete cascade NOT NULL,
  result varchar not null
);



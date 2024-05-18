-- 資料庫： `hami`

-- 資料表結構 `club`
CREATE TABLE `club` (
  `clubNo` char(4) NOT NULL,
  `clubTitle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 資料表結構 `course`
CREATE TABLE `course` (
  `courseNo` char(5) NOT NULL,
  `courseTitle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 資料表結構 `department`
CREATE TABLE `department` (
  `deptNo` char(5) NOT NULL,
  `deptTitle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 資料表結構 `grade`
CREATE TABLE `grade` (
  `gradeNo` char(2) NOT NULL,
  `gradeTitle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 資料表結構 `student`
CREATE TABLE `student` (
  `id` char(9) NOT NULL,
  `name` varchar(10) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `gender` char(1) NOT NULL,
  `grade` char(2) NOT NULL,
  `departId` char(5) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 資料表結構 `student_has_club`
CREATE TABLE `student_has_club` (
  `id` char(9) NOT NULL,
  `clubNo` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 資料表結構 `student_has_course`
CREATE TABLE `student_has_course` (
  `id` char(9) NOT NULL,
  `courseNo` char(5) NOT NULL,
  `semester` char(4) NOT NULL,
  `score` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 資料表索引 `club`
ALTER TABLE `club`
  ADD PRIMARY KEY (`clubNo`);

-- 資料表索引 `course`
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseNo`);

-- 資料表索引 `department`
ALTER TABLE `department`
  ADD PRIMARY KEY (`deptNo`);

-- 資料表索引 `grade`
ALTER TABLE `grade`
  ADD PRIMARY KEY (`gradeNo`);

-- 資料表索引 `student`
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

-- 資料表索引 `student_has_club`
ALTER TABLE `student_has_club`
  ADD PRIMARY KEY (`id`,`clubNo`);

-- 資料表索引 `student_has_course`
ALTER TABLE `student_has_course`
  ADD PRIMARY KEY (`id`,`courseNo`,`semester`);
  
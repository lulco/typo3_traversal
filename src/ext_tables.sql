CREATE TABLE `pages` (
	`lft` int(11) DEFAULT '0' NOT NULL,
	`rgt` int(11) DEFAULT '0' NOT NULL,
	`depth` int(11) DEFAULT '0' NOT NULL,

	KEY traverse (`lft`, `rgt`)
);
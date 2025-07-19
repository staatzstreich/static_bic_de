CREATE TABLE static_bic_de (
  uid INT(11) unsigned NOT NULL auto_increment,
  pid INT(11) unsigned NOT NULL DEFAULT '0',
  bank_ic INT(8) unsigned NOT NULL DEFAULT '0',
  bank_name VARCHAR(127) NOT NULL DEFAULT '',
  bank_bic VARCHAR(11) NOT NULL DEFAULT '',
  UNIQUE uid (uid),
  KEY bank_ic (bank_ic)
);

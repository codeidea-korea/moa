

UPDATE `classboard01`.`g5_shop_category` SET `ca_name` = '오리지널', `ca_order` = '8' WHERE (`ca_id` = '1030');
UPDATE `classboard01`.`g5_shop_category` SET `ca_name` = '자기계발' WHERE (`ca_id` = '1020');
UPDATE `classboard01`.`g5_shop_category` SET `ca_name` = '쿠킹' WHERE (`ca_id` = '1050');
UPDATE `classboard01`.`g5_shop_category` SET `ca_name` = '여행', `ca_order` = '7' WHERE (`ca_id` = '1080');
UPDATE `classboard01`.`g5_shop_category` SET `ca_order` = '3' WHERE (`ca_id` = '1040');
UPDATE `classboard01`.`g5_shop_category` SET `ca_order` = '4' WHERE (`ca_id` = '1070');

UPDATE `classboard01`.`g5_shop_category` SET `as_mobile_icon` = 'activity_ic_.svg' WHERE (`ca_id` = '1010');
UPDATE `classboard01`.`g5_shop_category` SET `as_mobile_icon` = 'self-development_ic_.svg' WHERE (`ca_id` = '1020');
UPDATE `classboard01`.`g5_shop_category` SET `as_mobile_icon` = 'healing_ic_.svg' WHERE (`ca_id` = '1030');
UPDATE `classboard01`.`g5_shop_category` SET `as_mobile_icon` = 'culture_ic_.svg' WHERE (`ca_id` = '1040');
UPDATE `classboard01`.`g5_shop_category` SET `as_mobile_icon` = 'cooking_ic_.svg' WHERE (`ca_id` = '1050');
UPDATE `classboard01`.`g5_shop_category` SET `as_mobile_icon` = 'social_ic_.svg' WHERE (`ca_id` = '1060');
UPDATE `classboard01`.`g5_shop_category` SET `as_mobile_icon` = 'beauty_ic_.svg' WHERE (`ca_id` = '1070');
UPDATE `classboard01`.`g5_shop_category` SET `as_mobile_icon` = 'career_ic_.svg' WHERE (`ca_id` = '1080');

commit;
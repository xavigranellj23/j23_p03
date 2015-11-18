INSERT INTO `tbl_pais` (`nom_pais`) VALUES ('Kenia');

INSERT INTO `tbl_grup_armat`(`id_pais`,`nom_ga`) 
(SELECT DISTINCT id_pais, 'Ejercito republicano keniano' AS `nom_ga`
FROM tbl_pais 
WHERE tbl_pais.nom_pais='Kenia');

INSERT INTO `tbl_lider` (`codi_ga`, `nom_lider`)
(SELECT DISTINCT `tbl_grup_armat`.`codi_ga`, 'Uhuru Kenyatta' AS `nom_lider`
FROM `tbl_pais` INNER JOIN `tbl_grup_armat` ON tbl_pais.id_pais=tbl_grup_armat.id_pais
WHERE tbl_pais.nom_pais='Kenia');


INSERT INTO `tbl_divisio` (`num_avions`,`num_vaixells`,`num_homes`,`num_tancs`,`codi_ga`)
(SELECT DISTINCT 10 AS `num_avions`,20 as `num_vaixells`, 1000 AS `num_homes`, 25 AS `num_tancs`,`tbl_grup_armat`.`codi_ga`
FROM `tbl_pais` INNER JOIN `tbl_grup_armat` ON `tbl_pais`.`id_pais`=`tbl_grup_armat`.`id_pais`
WHERE `tbl_pais`.`nom_pais`='Kenia');



INSERT INTO `tbl_cap_mili`(`id_lider`,`nom_cap_mili`, `num_div`, `rang_cap_mili`)
(SELECT DISTINCT tbl_lider.id_lider, 'Julio Karangi',`tbl_divisio`.`num_div`, 'Jefe de la fuerzas armadas' AS  `rang_cap_mili`
FROM `tbl_pais` INNER JOIN `tbl_grup_armat` ON tbl_pais.id_pais=tbl_grup_armat.id_pais
INNER JOIN tbl_divisio ON `tbl_grup_armat`.`codi_ga`=`tbl_divisio`.`codi_ga`
INNER JOIN tbl_lider ON tbl_lider.codi_ga= tbl_grup_armat.codi_ga
WHERE `tbl_pais`.`nom_pais`='Kenia');
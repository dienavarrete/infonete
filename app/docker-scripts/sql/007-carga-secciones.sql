insert into seccion (id_genero, id_publicacion, id_estado, estado_registro) 
values (1, 1, 3, 1),
        (2, 1, 3, 1),
        (1, 2, 3, 1),
        (2, 2, 3, 1),
        (1, 3, 3, 1),
        (2, 3, 3, 1);

-- Error Code: 1452. Cannot add or update a child row: a foreign key constraint fails (`infonete`.`seccion`, CONSTRAINT `seccion_ibfk_2` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id`))

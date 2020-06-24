insert into rol (codigo, descripcion)
values ('10', 'Administrador'),
       ('20', 'Contenidista'),
       ('30', 'Lector');

insert into usuario (usuario,
                     password,
                     id_rol)
values ('admin',
        'e10adc3949ba59abbe56e057f20f883e',
        (select id from rol where codigo = '10')),
        ('fran',
        '5f4dcc3b5aa765d61d8327deb882cf99',
        (select id from rol where codigo = '10'));
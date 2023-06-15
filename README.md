# Como usar

instale o docker

Com o docker instalado, rode o comando `docker pull mysql` para baixar a imagem do `mysql`

Feito isso você irá precisar subir um container com para usar seu banco de dados.

Use o seguinte comando para subir um container mysql e obter o seu ip

```bash
docker run --name mysql-database -e MYSQL_ROOT_PASSWORD=0000 -d mysql:latest

docker inspect --format '{{ .NetworkSettings.IPAddress }}' CONTAINER_ID
```

Aqui `MYSQL_ROOT_PASSWORD` você pode definir a senha que preferir, lembre-se de mudar `CONTAINER_ID` para o id do seu container mysql.

Agora você pode pegar o id e colocar lá no arquivo `conection_db.php` em `backend/shared/connection_db.php` no seguinte trecho:

```php
...der("Access-Control-Allow-Origin: *");

$hostname = "CONTAINER_ID";
$username =...
```

Feito isso entre o mysql com o docker 

```
docker exec -it mysql-database mysql -uroot -p 
```

Feito isso, vai pedir a sua senha.

Agora você precisa copiar o conteúdo do arquivo `database.sql` cole no seu banco mysql que você acabou de se conectar.

Good Hanking!

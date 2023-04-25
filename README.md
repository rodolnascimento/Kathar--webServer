Universidade Federal do Maranhão

**Segurança em Redes**

# Laboratório - *Web Server explorando vulnerabilidade*

## Objetivo

O objetivo deste laboratório é configurar um servidor *web*, usando [*Apache*](https://httpd.apache.org/)

![Topologia de Rede][1]

## Introdução
o objetivo desse laboratorio é simular um ambiente web e explorar algumas vulnerabilidades, vamos configurar um servidor *web* *Apache* com o objetivo de servir uma página *web* simples.
Em seguida, vamos adicionar um servidor de base de dados *SQL*, que será usado pelo servidor *web*.


## Exercício 1 -- Servidor *web*

O servidor *Apache* atende requisições, por exemplo, páginas *HTML*, para a *world wide web*.
Este servidor foi desenvolvido por Tim Berners-lee como um projeto de código aberto e é, atualmente, o mais usado a nível mundial.

O laboratório presente consiste em implementar um servidor *Apache* e configurá-lo, de modo a que, ao nível de aplicação, sejam explorardas algumas vulnerabilidades sobre os documentos que estão acessíveis.

Vamos agora executar alguns passos para configurar o *Apache*.

1. Inicie o laboratório no diretorio dos arquvivos baixados:
```bash
kathara lstart
```
2. na maquina internet, inicie o servidor apache:

```bash
/etc/init.d/apache2 start
```

3. Verifique que no  `internet` o serviço `apache2` está funcionando corretamente.

```bash
/etc/init.d/apache2 status
```

A pasta `/etc/init.d` contém os serviços de uma máquina *Linux* no modo `SysVInit`.
Atualmente será mais comum encontrar o comando `systemctl` do modo `systemd` em vez do `SysVInit`.
Ambos são alternativas para gerir a inicialização do sistema operacional e respetivos serviços.

3. No debian10, os URLs disponibilizados pelo *Apache*, mapeiam arquivos dentro da pasta `/var/www/html`.
Dentro do dispositivo `internet` execute o comando `curl` para solicitar o arquivo `public/script.php`

```bash
curl -v 'http://143.102.212.100/public/script.php'

```

4. Após fazer este pedido, observe como o *Apache* guarda no log `/var/log/apache2/access.log` a informação relativa ao pedido que foi feito.

```bash
tail -n 10 /var/log/apache2/access.log 
```

----

## Exercício 2 -- Servidor de banco de dados

Agora que temos o servidor *Apache* configurado, vamos adicionar um novo servidor à nossa rede que terá um serviço *SQL* ([MariaDB](https://mariadb.org/)), recebendo requisições na porta `3306.
Este serviço será usado pelo dispositivo `internet` na página `http://<ip 143.102.212.100>/

Na máquina `internet` vamos configurar um servidor de *SQL*.
Agora é necessário ligá-lo à rede de modo a que esteja acessível pelo servidor.

Siga os seguintes passos:

1. na maquina internet inicie o servidor de banco de dados 
```bash
/etc/init.d/mysql start
```
2. em seguida utilize o comando para acessar o console, a senha padrão é admin

```bash
mysql -u root --password
```
3. na console do servidor de banco de dados, use o comando para criar a base de dados 

```bash
create database meuteste;
```
4. use o comando para utilizar a base de dados criada


```bash
use database meuteste;

```
5. utlize o comando para criar a tabela


```bash
create table config(id integer, nome varchar(20));
```
6. use o comando para inserir registros na tabela;


```bash
insert into config(1,'seunome'); 
```
7. saia do console 

```bash
quit
```

----

## Exercício 3 -- *Verificando Falhas de segurança*

Agora que temos a nossa aplicação *web* funcionando de forma correta, vamos observar o comportamento do ponto de vista de um usuário.
Recorde a topologia de rede que utilizou e vamos observar o comportamento a partir do `cliente1`.

1. Infelizmente, ainda temos problemas na nossa configuração de rede.
Observe o que acontece se executar o seguinte comando no cliente:

```bash
nmap <ip do sqlserver>
```

2. A porta do *MariaDB* `3306` está acessível ao mundo exterior.
Isto tem dois problemas.
Em primeiro lugar é possível a um atacante tentar descobrir a nossa senha, principalmente pois a senha é `password`, substitua pelo ip 143.102.212.100 que é o correspondente do servidor:

```bash
# a partir do pc1:
mysql -u root -D sirs -e "SELECT * from config;" -h 143.102.212.100 -ppassword
```

Em segundo lugar, mesmo sem saber a senha, é possível que o atacante "bombardeie" a porta com pedidos de tentativas de estabelecimento de ligação que consumam recursos no servidor e impeçam ligações legítimas de serem estabelecidas.

----

## Referências

- *Kathará*, [https://github.com/KatharaFramework/Kathara/wiki]

  [1]: media/LampServer.png


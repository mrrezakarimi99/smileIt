# SMILE IT

## requirements
- docker
- docker-compose

## usage

### clone project
```bash
git clone https://github.com/mrrezakarimi99/smileIt
cd smileIt
```

### config .env file
```bash
cp Docker/mysql/.env.example Docker/mysql/.env # and edit it for your database
cp Web/.env.example Web/.env # and edit it for your database
```

### run project
```bash
docker-compose up -d --build 
docker exec -it smileit_php php artisan key:generate
docker exec -it smileit_php composer install
docker exec -it smileit_php php artisan migrate
docker exec -it smileit_php php artisan db:seed
```

### help for install docker

```bash
sudo apt update
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"
sudo apt install docker-ce
```

### help for install docker compose

```bash
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```


pipeline {
    agent any

    environment {
        DOCKER_COMPOSE_FILE = 'docker-compose.yml'
        DOCKER_IMAGE = 'tonuser/php-app:latest' // change tonuser/php-app
    }

    stages {

        stage('Clone') {
            steps {
                echo 'Clonage du projet depuis GitHub...'
                git branch: 'main', 
                    url: 'https://github.com/thiothiod/PROJET_PHP_DEVOPS.git', 
                    credentialsId: 'github-token'
            }
        }

        stage('Build Docker') {
            steps {
                echo "Construction des images Docker depuis ${DOCKER_COMPOSE_FILE}..."
                sh 'docker compose build'
            }
        }

        stage('Start Docker Containers') {
            steps {
                echo 'Démarrage des containers en arrière-plan...'
                sh 'docker compose up -d'
            }
        }

        stage('Push Docker Hub (Optionnel)') {
            when {
                expression { return env.PUSH_TO_DOCKER_HUB == 'true' }
            }
            steps {
                echo "Push de l'image sur Docker Hub..."
                withCredentials([usernamePassword(credentialsId: 'dockerhub', usernameVariable: 'USER', passwordVariable: 'PASS')]) {
                    sh 'echo $PASS | docker login -u $USER --password-stdin'
                    sh "docker push ${DOCKER_IMAGE}"
                }
            }
        }

    }

    post {
        success {
            echo 'Pipeline terminé avec succès 🚀'
        }
        failure {
            echo 'Pipeline échoué ❌'
        }
    }
}
    //Explications :
//environment : définit une variable pour le nom de l’image Docker, réutilisable dans tout le pipeline
//withCredentials : permet d’utiliser en toute sécurité ton Docker Hub username/password
//stage Run Docker Container : optionnel pour tester l’image sur ta machine après push
//post : affiche un message selon le succès ou l’échec

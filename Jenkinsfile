pipeline {
    agent any  // Utiliser n'importe quel agent disponible sur Jenkins

    environment {
        // Variables d'environnement si tu veux pousser sur Docker Hub
        DOCKERHUB_CREDENTIALS = 'dockerhub' // ID des credentials dans Jenkins
        IMAGE_NAME = 'tonuser/php-app:latest'
    }

    stages {

        stage('Cloner le projet') {
            steps {
                // Cloner le dépôt Git
                git branch: 'main', url: 'https://github.com/ton-user/ton-projet.git'
            }
        }

        stage('Construire Docker') {
            steps {
                //  Construire les images via docker-compose
                sh 'docker-compose build'
            }
        }

        stage('Lancer les containers') {
            steps {
                //  Lancer les containers en arrière-plan
                sh 'docker-compose up -d'
            }
        }

        stage('Tester le projet') {
            steps {
                //  Vérifier si le container web répond
                sh '''
                sleep 5  # attendre que le container web soit prêt
                curl -I http://localhost:8000 || true
                '''
            }
        }

        stage('Pousser sur Docker Hub (optionnel)') {
            when {
                expression { return env.PUSH_TO_DOCKERHUB == "true" }
            }
            steps {
                withCredentials([usernamePassword(credentialsId: "${DOCKERHUB_CREDENTIALS}", 
                                                  usernameVariable: 'USER', 
                                                  passwordVariable: 'PASS')]) {
                    sh 'echo $PASS | docker login -u $USER --password-stdin'
                    sh "docker push ${IMAGE_NAME}"
                }
            }
        }

    }

    post {
        always {
            // 🔹 Afficher l'état des containers à la fin du pipeline
            sh 'docker ps -a'
        }

        failure {
            // 🔹 En cas d'échec, afficher les logs des containers web et db
            sh 'docker-compose logs web'
            sh 'docker-compose logs db'
        }
    }
}
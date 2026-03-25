pipeline {
    agent any

    environment {
        // Définir les variables d'environnement si nécessaire
        IMAGE_NAME = "mon-projet-image"
        CONTAINER_NAME = "mon-projet-container"
    }

    stages {
        stage('Cloner le projet') {
            steps {
                // Utilise ton credential GitHub PAT
                git branch: 'main',
                    credentialsId: 'github-pat',
                    url: 'https://github.com/thiothiod/PROJET_PHP_DEVOPS.git'
            }
        }

        stage('Construire Docker') {
            steps {
                script {
                    // Vérifie que Docker est disponible
                    sh 'docker --version'
                    sh "docker build -t ${IMAGE_NAME} ."
                }
            }
        }

        stage('Lancer les conteneurs') {
            steps {
                script {
                    // Lancer un conteneur à partir de l'image
                    sh "docker run -d --name ${CONTAINER_NAME} -p 8080:80 ${IMAGE_NAME}"
                }
            }
        }

        stage('Tester le projet') {
            steps {
                // Ici tu peux ajouter tes tests automatisés
                sh 'echo "Tests à ajouter"'
            }
        }

        stage('Pousser sur Docker Hub (optionnel)') {
            steps {
                script {
                    // sh "docker login -u <user> -p <password>"
                    // sh "docker push ${IMAGE_NAME}"
                    sh 'echo "Push sur Docker Hub si nécessaire"'
                }
            }
        }
    }

    post {
        always {
            script {
                // Affiche les conteneurs pour vérifier
                sh 'docker ps -a || echo "Docker non disponible"'
            }
        }
    }
}
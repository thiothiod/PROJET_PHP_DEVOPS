pipeline {
    agent any

    stages {
        stage('Cloner le projet') {
            steps {
                // Utilise la credential avec ID github-pat
                git(
                    url: 'https://github.com/thiothiod/PROJET_PHP_DEVOPS.git',
                    branch: 'main',
                    credentialsId: 'github-pat'
                )
            }
        }

        stage('Construire Docker') {
            steps {
                sh 'docker-compose build'
            }
        }

        stage('Lancer les conteneurs') {
            steps {
                sh 'docker-compose up -d'
            }
        }

        stage('Tester le projet') {
            steps {
                sh 'docker exec -it nom_du_conteneur php artisan test'
            }
        }
    }

    post {
        always {
            sh 'docker ps -a'
        }
    }
}
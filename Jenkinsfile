pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                git url: 'https://github.com/ton-user/ton-projet.git',
                    credentialsId: 'github-pat'
            }
        }
        stage('Build Docker') {
            steps {
                sh 'docker-compose up --build -d'
            }
        }
        stage('Tests') {
            steps {
                sh 'docker exec mon_conteneur php artisan test'
            }
        }
    }
}
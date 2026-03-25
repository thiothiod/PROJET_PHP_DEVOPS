pipeline {
    agent any

    stages {

        stage('Clone') {
            steps {
                git 'https://github.com/ton-user/ton-projet.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t tonuser/php-app:latest .'
            }
        }

        stage('Push Docker Hub') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerhub', usernameVariable: 'USER', passwordVariable: 'PASS')]) {
                    sh 'echo $PASS | docker login -u $USER --password-stdin'
                    sh 'docker push tonuser/php-app:latest'
                }
            }
        }

    }
}
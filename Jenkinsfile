pipeline {
    agent any

    environment {
        COMPOSE_PROJECT_NAME = "miniapp"
    }

    stages {
        stage('Préparer') {
            steps {
                script {
                    sh "docker-compose down || true"
                }
            }
        }

        stage('Build') {
            steps {
                script {
                    sh "docker-compose build --no-cache"
                }
            }
        }

        stage('Démarrer les conteneurs') {
            steps {
                script {
                    sh "docker-compose up -d"
                }
            }
        }

        stage('Vérifier PostgreSQL') {
            steps {
                script {
                    sh '''
                    until docker-compose exec db pg_isready -U postgres; do
                        echo "Postgres non prêt, attente 2s..."
                        sleep 2
                    done
                    echo "Postgres prêt ✅"
                    '''
                }
            }
        }

        stage('Test application') {
            steps {
                script {
                    sh "curl -I http://localhost:8000 || echo 'Impossible de tester maintenant'"
                }
            }
        }
    }

    post {
        always {
            sh "docker-compose down"
        }
    }
}
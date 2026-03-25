pipeline {
    agent any

    environment {
        // Ton identifiant GitHub PAT enregistré dans Jenkins
        GITHUB_CREDENTIALS = 'github-pat'
    }

    stages {
        stage('Cloner le dépôt') {
            steps {
                git branch: 'main',
                    credentialsId: "${GITHUB_CREDENTIALS}",
                    url: 'https://github.com/thiothiod/PROJET_PHP_DEVOPS.git'
            }
        }

        stage('Placeholder Docker Build') {
            steps {
                echo 'Ici tu construiras ton image Docker plus tard...'
            }
        }

        stage('Placeholder Docker Run') {
            steps {
                echo 'Ici tu lanceras tes conteneurs Docker plus tard...'
            }
        }

        stage('Placeholder Tests') {
            steps {
                echo 'Ici tu exécuteras tes tests plus tard...'
            }
        }
    }

    post {
        success {
            echo 'Pipeline terminé avec succès : clone Git OK'
        }
        failure {
            echo 'Pipeline échoué : vérifier les logs'
        }
    }
}
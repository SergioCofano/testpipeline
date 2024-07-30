pipeline {
    agent any
    environment {
        staging_server = "127.0.0.1"  // Usando la porta predefinita per SSH
    }
    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/SergioCofano/testpipeline.git'
            }
        }
        stage('Deploy to Remote') {
            steps {
                script {
                    echo "Deploying to ${staging_server}"
                    sh '''
                        ssh -o StrictHostKeyChecking=no root@127.0.0.1 "echo Connection Successful"
                        scp ${WORKSPACE}/* root@127.0.0.1:/Utenti/Utente/wa/testpipeline
                    '''
                }
            }
        }
    }
}
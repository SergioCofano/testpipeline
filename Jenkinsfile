pipeline {
    agent any
    environment {
        staging_server = "127.0.0.1"
        ssh_port = "2222"
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
                    withCredentials([sshUserPrivateKey(credentialsId: 'your-credential-id', keyFileVariable: 'SSH_KEY')]) {
                        echo "Deploying to ${staging_server}:${ssh_port}"
                        sh """
                            ssh -i $SSH_KEY -o StrictHostKeyChecking=no -p ${ssh_port} root@${staging_server} "echo Connection Successful"
                            scp -i $SSH_KEY -P ${ssh_port} -o StrictHostKeyChecking=no -r ${WORKSPACE}/* root@${staging_server}:/Utenti/Utente/wa/testpipeline
                        """
                    }
                }
            }
        }
    }
}
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
                    withCredentials([sshUserPrivateKey(credentialsId: '04ca3865-4383-49d7-b66b-e47d3bab440f', keyFileVariable: 'SSH_KEY')]) {
                        echo "Deploying to ${staging_server}:${ssh_port}"
                        sh '''
                            set -x
                            mkdir -p ~/.ssh
                            ssh-keyscan -p ${ssh_port} ${staging_server} 2>&1 | tee ssh-keyscan.log >> ~/.ssh/known_hosts
                            echo "Contents of ~/.ssh/known_hosts:"
                            cat ~/.ssh/known_hosts
                            echo "Contents of ssh-keyscan.log:"
                            cat ssh-keyscan.log
                            ssh -i $SSH_KEY -o StrictHostKeyChecking=no -p ${ssh_port} root@${staging_server} "echo Connection Successful"
                            scp -i $SSH_KEY -P ${ssh_port} -o StrictHostKeyChecking=no -r ${WORKSPACE}/* root@${staging_server}:/Utenti/Utente/wa/testpipeline
                        '''
                    }
                }
            }
        }
    }
}
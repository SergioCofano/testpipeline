pipeline {
    agent any
    environment {
        staging_server = "10.1.3.189"
        ssh_port = "22"
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
                    withCredentials([usernamePassword(credentialsId: 'ServerTest', usernameVariable: 'utente', passwordVariable: 'S3rv1z10.2024!')]) {
                        echo "Deploying to ${staging_server}:${ssh_port}"
                        sh '''
                            set -x

                            # Setup SSH keyscan for host verification
                            mkdir -p ~/.ssh
                            ssh-keyscan -p ${ssh_port} ${staging_server} 2>&1 | tee ssh-keyscan.log >> ~/.ssh/known_hosts
                            echo "Contents of ~/.ssh/known_hosts:"
                            cat ~/.ssh/known_hosts
                            echo "Contents of ssh-keyscan.log:"
                            cat ssh-keyscan.log

                            # Deploy files using sshpass for password authentication
                            sshpass -p ${S3rv1z10.2024!} scp -o StrictHostKeyChecking=no -P ${ssh_port} -r ${WORKSPACE}/* ${utente}@${staging_server}:/Utenti/Utente/wa/testpipeline
                        '''
                    }
                }
            }
        }
    }
}
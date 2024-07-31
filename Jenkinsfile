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
                    // withCredentials([sshUserPrivateKey(credentialsId: '04ca3865-4383-49d7-b66b-e47d3bab440f', keyFileVariable: 'SSH_KEY')]) {
                       withCredentials([usernamePassword(credentialsId: 'ServerTest', usernameVariable: 'utente' , passwordVariable: 'S3rv1z10.2024!')]) {
                        echo "Deploying to ${staging_server}:${ssh_port}"
                        sh '''
                            set -x
                            mkdir -p ~/.ssh
                            ssh-keyscan -p ${ssh_port} ${staging_server} 2>&1 | tee ssh-keyscan.log >> ~/.ssh/known_hosts
                            echo "Contents of ~/.ssh/known_hosts:"
                            cat ~/.ssh/known_hosts
                            echo "Contents of ssh-keyscan.log:"
                            cat ssh-keyscan.log

                            # Create temporary SSH config file without errors
                            echo "Host staging
                            HostName ${staging_server}
                            Port ${ssh_port}
                            User root
                            IdentityFile ${SSH_KEY}
                            StrictHostKeyChecking no" > ssh_config

                            # Test SSH connection using the temporary config file
                            ssh -F ssh_config staging echo Connection Successful

                            # Deploy files
                            scp -F ssh_config -r ${WORKSPACE}/* root@${staging_server}:/Utenti/Utente/wa/testpipeline
                        '''
                    }
                }
            }
        }
    }
}
pipeline{
    agent any
    environment{
        staging_server= "
    127.0.0.1:5500"
    }
    stages{
        stage('Deploy to Remote'){
            steps{
                sh 'scp ${WORKSPACE}/* root@${staging_server}:/Utenti/Utente/wa/testpipeline'
            }
        }
    }
}
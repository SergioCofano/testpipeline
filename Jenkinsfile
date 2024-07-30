pipeline{
    agent any
    environment{
        staging_server= "
    8080:8080"
    }
    stages{
        stage('Deploy to Remote'){
            steps{
                sh 'scp ${WORKSPACE}/* root@${staging_server}:/Utenti/Utente/wa/testpipeline'
            }
        }
    }
}
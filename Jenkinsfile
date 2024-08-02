pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                // Checkout del codice dal repository Git
                git url: 'https://github.com/SergioCofano/testpipeline.git', branch: 'main'
            }
        }
        
        stage('Install Dependencies and Run Tests on Remote Server') {
            steps {
                sshagent(['php_server']) {
                    sh '''
                    ssh user@your-server << EOF
                        cd /path/to/your/project
                        composer install
                        vendor/bin/phpunit --log-junit /path/to/results/phpunit.xml -c tests/phpunit.xml
                    EOF
                    '''
                }
            }
        }

        stage('Deploy PHP application') {
            steps {
                sshPublisher(publishers: [sshPublisherDesc(
                    configName: 'php_server',
                    transfers: [sshTransfer(
                        cleanRemote: false,
                        excludes: '',
                        execCommand: '',
                        execTimeout: 120000,
                        flatten: false,
                        makeEmptyDirs: false,
                        noDefaultExcludes: false,
                        patternSeparator: '[, ]+',
                        remoteDirectory: '/www/wwwroot/testrepo',
                        remoteDirectorySDF: false,
                        removePrefix: '',
                        sourceFiles: '**/*.php'
                    )],
                    usePromotionTimestamp: false,
                    useWorkspaceInPromotion: false,
                    verbose: false
                )])
            }
        }
    }
    
    post {
        always {
            // Pubblica i risultati dei test
            sshagent(['php_server']) {
                sh '''
                scp user@your-server:/path/to/results/phpunit.xml results/phpunit.xml
                '''
            }
            junit 'results/phpunit.xml'
        }
        failure {
            mail to: 'you@example.com',
                 subject: "Pipeline failed: ${currentBuild.fullDisplayName}",
                 body: "Something is wrong with ${env.JOB_NAME} #${env.BUILD_NUMBER}\n${env.BUILD_URL}"
        }
    }
}
// test
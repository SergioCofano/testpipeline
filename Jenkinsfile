pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Install Dependencies') {
            steps {
                script {
                    echo 'Installing dependencies...'
                    sh 'composer install'
                }
            }
        }
        stage('Run Tests') {
            steps {
                script {
                    echo 'Running tests...'
                    sh 'mkdir -p tests'  // Assicurati che la directory tests esista
                    sh 'vendor/bin/phpunit --log-junit tests/junit-report.xml --debug'  // Esegui PHPUnit con debug
                }
            }
        }
        stage('Debug Report') {
            steps {
                script {
                    echo 'Debugging report...'
                    sh 'ls -al tests'  // Mostra i file nella directory tests
                    sh 'cat tests/junit-report.xml || echo "Report file not found"'  // Mostra il contenuto del report XML
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
            script {
                echo 'Publishing test results...'
                junit 'tests/junit-report.xml'  // Pubblica i risultati dei test
            }
        }
        success {
            echo 'Deployment completed successfully.'
        }
        failure {
            echo 'Deployment failed.'
        }
    }
}

pipeline {
    agent any

    stages {
        stage('Deploy PHP application') {
            steps {
                sshPublisher(publishers: [sshPublisherDesc(configName: 'php_server', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: '', execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '/www/wwwroot/testrepo', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '**/*.php')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
            }
        }
    }
}
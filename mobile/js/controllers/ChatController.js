lynxApp.config( [
               '$compileProvider',
               function( $compileProvider )
               {   
                   $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|skype|ymsgr|javascript|callto|viber|mailto|chrome-extension):/);
                   // Angular before v1.2 uses $compileProvider.urlSanitizationWhitelist(...)
               }
             ]);
function ChatController($scope,$sce)
{
    $scope.supporters = supporters;
    $scope.to_trusted = function(html_code) {
        return $sce.trustAsHtml(html_code);
    };
    
}
ChatController.$inject = ['$scope','$sce'];
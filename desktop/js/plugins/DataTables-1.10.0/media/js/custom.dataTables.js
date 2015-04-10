
function datatableOptions(opt) {
    var defaultOPT = {
        "bSort": false,
        "bProcessing": true,
        "bServerSide": true,
        "drawCallback": function(settings) {
            var api = this.api();
            var $wrapper = $(this).parents('.dataTables_scroll:first');
            var $chkall = $('.chk-all', $wrapper);
            var $chk = $($chkall.attr('data-target'), $wrapper);

            $chk.change(function() {
                var $elm = $(this);
                $elm.parents('tr:first').toggleClass('checked', $elm.prop('checked'));
            });
            $chkall.each(function() {
                var $this = $(this);
                if (!$this.attr('data-event')) {
                    $this.change(function() {
                        $chk.prop('checked', $this.prop('checked')).trigger('change');
                    });
                    $this.attr('data-event', 1);
                }
            });
        }
    };
    for (var i in opt) {
        defaultOPT[i] = opt[i];
    }
    return defaultOPT;
}
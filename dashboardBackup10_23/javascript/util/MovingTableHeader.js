/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        function UpdateTableHeaders() {
           // alert();
            $("div.divTableWithFloatingHeader1").each(function() {
                var originalHeaderRow = $(".tableFloatingHeaderOriginal1", this);
                var floatingHeaderRow = $(".tableFloatingHeader1", this);
                var offset = $(this).offset();
                var scrollTop = $(window).scrollTop();
                if ((scrollTop > offset.top) && (scrollTop < offset.top + $(this).height())) {
                    floatingHeaderRow.css("visibility", "visible");
                    floatingHeaderRow.css("top", Math.min(scrollTop - offset.top, $(this).height() - floatingHeaderRow.height()) + "px");

                    // Copy cell widths from original header
                    $("th", floatingHeaderRow).each(function(index) {
                        var cellWidth = $("th", originalHeaderRow).eq(index).css('width');
                        $(this).css('width', cellWidth);
                    });

                    // Copy row width from whole table
                    floatingHeaderRow.css("width", $(this).css("width"));
                }
                else {
                    floatingHeaderRow.css("visibility", "hidden");
                    floatingHeaderRow.css("top", "0px");
                }
            });
        }

        function floatTableHeaderInitialize() { 
           // alert('hey');
            $("table.tableWithFloatingHeader").each(function() {
                $(this).wrap("<div class=\"divTableWithFloatingHeader1\" style=\"position:relative\"></div>");

                var originalHeaderRow = $("tr:first", this)
                originalHeaderRow.before(originalHeaderRow.clone());
                var clonedHeaderRow = $("tr:first", this)

                clonedHeaderRow.addClass("tableFloatingHeader1");
                clonedHeaderRow.css("position", "absolute");
                clonedHeaderRow.css("top", "0px");
                clonedHeaderRow.css("left", $(this).css("margin-left"));
                clonedHeaderRow.css("visibility", "hidden");

                originalHeaderRow.addClass("tableFloatingHeaderOriginal1");
            });
            UpdateTableHeaders();
            $(window).scroll(UpdateTableHeaders);
            $(window).resize(UpdateTableHeaders);
        };
        

        function UpdateTableHeadersIp() {
           // alert();
            $("div.divTableWithFloatingHeaderIp").each(function() {
                var originalHeaderRow = $(".tableFloatingHeaderOriginalIp", this);
                var floatingHeaderRow = $(".tableFloatingHeaderIp", this);
                var offset = $(this).offset();
                var scrollTop = $(window).scrollTop();
                if ((scrollTop > offset.top) && (scrollTop < offset.top + $(this).height())) {
                    floatingHeaderRow.css("visibility", "visible");
                    floatingHeaderRow.css("top", Math.min(scrollTop - offset.top, $(this).height() - floatingHeaderRow.height()) + "px");

                    // Copy cell widths from original header
                    $("th", floatingHeaderRow).each(function(index) {
                        var cellWidth = $("th", originalHeaderRow).eq(index).css('width');
                        $(this).css('width', cellWidth);
                    });

                    // Copy row width from whole table
                    floatingHeaderRow.css("width", $(this).css("width"));
                }
                else {
                    floatingHeaderRow.css("visibility", "hidden");
                    floatingHeaderRow.css("top", "0px");
                }
            });
        }

        function floatTableHeaderInitializeIp() {  
           // alert('hey');
            $("table.tableWithFloatingHeaderIp").each(function() {
                $(this).wrap("<div class=\"divTableWithFloatingHeaderIp\" style=\"position:relative\"></div>");

                var originalHeaderRow = $("tr:first", this)
                originalHeaderRow.before(originalHeaderRow.clone());
                var clonedHeaderRow = $("tr:first", this)

                clonedHeaderRow.addClass("tableFloatingHeaderIp");
                clonedHeaderRow.css("position", "absolute");
                clonedHeaderRow.css("top", "0px");
                clonedHeaderRow.css("left", $(this).css("margin-left"));
                clonedHeaderRow.css("visibility", "hidden");

                originalHeaderRow.addClass("tableFloatingHeaderOriginalIp");
            });
            UpdateTableHeadersIp();
            $(window).scroll(UpdateTableHeadersIp);
            $(window).resize(UpdateTableHeadersIp);
        };
        

    

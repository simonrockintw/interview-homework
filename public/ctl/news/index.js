;
window.addEventListener("DOMContentLoaded", function(event) {
    var endpoint = $("#config").data("endpoint");

    var newsResource = new $.resource({
        endpoint: endpoint,
        ajaxSettings: {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            dataType: "json"
        }
    });

    var update_endpoint = $("#config_update").data("endpoint");

    var newsUpdateResource = new $.resource({
        endpoint: update_endpoint,
        ajaxSettings: {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            dataType: "json"
        }
    });

    function deleteRow(data) {
        var endpoint = $("#config_update").data("endpoint");

        var deleteResource = new $.resource({
            endpoint: endpoint,
            ajaxSettings: {
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                dataType: "json"
            }
        });

        deleteResource.delete(data.id).done(function (res) {
            if (res.status == '200') {
                Swal.fire({
                    icon: 'success',
                    title: '刪除成功',
                })
                list();
                return;
            }

            Swal.fire({
                icon: 'error',
                title: '刪除失敗',
            })
            return false;
        });

        return;
    }

    function list() {
        var range = $('#match-range').val() !== '' ? $('#match-range').val().split(' - ') : null;

        newsResource.find({
            after: (range !== null ? range[0] : null),
            before: (range !== null ? range[1] : null),
        }).done(function(res) {
            var tableSelector = '#news-list';
            var data = res.data || new Array();

            if ($.fn.dataTable.isDataTable(tableSelector)) {
                $(tableSelector).DataTable().clear().rows.add(data).draw(false);
                return;
            }

            $(tableSelector).DataTable({
                responsive: true,
                autoWidth: false,
                // order: [[ 7, "desc" ]],
                data: data,
                columns: [
                    {
                        name: 'id',
                        data: 'id',
                        class: 'text-center text-sm',
                    },
                    {
                        name: 'author_name',
                        data: 'author_name',
                        class: 'text-center text-sm',
                    },
                    {
                        name: 'title',
                        data: 'title',
                        class: 'text-center text-sm',
                    },
                    {
                        name: 'created_at',
                        data: 'created_at',
                        class: 'text-center text-sm',
                        render: function(data) {
                            if (data == null) {
                                return '-';
                            }
                            var date = new Date(data)
                            return moment(date).format('YYYY-MM-DD HH:mm:ss');
                        }
                    },
                    {
                        name: 'updated_at',
                        data: 'updated_at',
                        class: 'text-center text-sm',
                        render: function(data) {
                            if (data == null) {
                                return '-';
                            }
                            var date = new Date(data)
                            return moment(date).format('YYYY-MM-DD HH:mm:ss');
                        }
                    },
                    {
                        name: 'published_at',
                        data: 'published_at',
                        class: 'text-center text-sm',
                        render: function(data) {
                            if (data == null) {
                                return '-';
                            }
                            var date = new Date(data)
                            return moment(date).format('YYYY-MM-DD HH:mm:ss');
                        }
                    },
                    {
                        name: 'display',
                        data: 'display',
                        class: 'text-center text-sm',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            var html = '<input type="checkbox" checked=""></input>';
                            if (data == 1) {
                                html = '<input type="checkbox" checked="checked"></input>';
                            }
                            return html;
                        },
                        createdCell: function(td, cellData, rowData) {
                            var switch_btn = $(td).find('input').bootstrapSwitch({
                                'onText':'上架',
                                'offText':'下架',
                                'size': 'small',
                                'onColor':'success',
                                'offColor':'danger',
                                // 'labelWidth':'0',
                                'state': cellData});
                            $(td).find('input').on('switchChange.bootstrapSwitch', function() {
                                Swal.fire({
                                    title: '更改狀態',
                                    text: "確定要變更狀態嗎？",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: '取消',
                                    confirmButtonText: '變更'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        newsUpdateResource.put(rowData.id, {
                                            display: (cellData == 1 ? 0 : 1)
                                        }).done(function() {
                                            Toast.fire({
                                                icon: "success",
                                                title: "修改成功",
                                            });
                                        }).fail(function() {
                                            Toast.fire({
                                                icon: "error",
                                                title: "修改失敗",
                                            });
                                            switch_btn.bootstrapSwitch('toggleState', true);
                                        });
                                        return;
                                    } else {
                                        switch_btn.bootstrapSwitch('toggleState', true);
                                    }
                                })
                            });
                        }
                    },
                    {
                        name: 'action',
                        data: 'id',
                        class: 'text-center text-sm',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var html = '<div class="btn-group">\n' +
                                '<div class="btn-group show dropleft">\n' +
                                '<button type="button" class="btn btn-default dropdown-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                                '<i class="fas fa-ellipsis-v"></i></button>\n' +
                                '<div class="dropdown-menu" style="min-width: 70px !important;">\n' +
                                '<a class="dropdown-item" href="'+update_endpoint+'/'+data+'/edit">編輯</a>\n' +
                                '<a class="dropdown-item ctl-delete" href="#">刪除</a>\n' +
                                '</div>\n' +
                                '</div>\n' +
                                '</div>'
                            return html;
                        },
                        createdCell: function(td, cellData, rowData) {
                            $(td).on('click', '.ctl-delete', function(e) {
                                Swal.fire({
                                    title: '刪除資料',
                                    text: "確定要刪除此筆資料嗎？",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: '取消',
                                    confirmButtonText: '變更'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        deleteRow(rowData)
                                        return;
                                    }
                                    return;
                                })
                            });
                        }
                    }
                ],
            });
        });
    }

    $('.card').on('click', '.ctl-search', function(e) {
        list();
    });

    $('#match-range').daterangepicker({
        timePicker: true,
        timePickerSeconds: true,
        timePickerIncrement: 1,
        timePicker24Hour: true,
        locale: {
            format: 'Y-MM-DD HH:mm:ss'
        }
    })

    list();
});

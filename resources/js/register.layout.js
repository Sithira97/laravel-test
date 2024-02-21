let modalSection = document.querySelector(".register-modal .modal");
if (modalSection == null) {
    modalSection = document.querySelector(".register-card .card");
};
let formSelected = modalSection.querySelector(".form-container form")
let stepList = modalSection.querySelectorAll(".current-screen li");

let currrentFormNumber = 0;

let itemCount = stepList.length;
let showProgressContainer = modalSection.querySelector('#show-progress');
for (let i = 0; i < itemCount; i++) {
    const newDiv = document.createElement('div');
    newDiv.id = `screen${i + 1}`;
    newDiv.classList = `progress-container`;
    if (itemCount < 3) {
        newDiv.style.width = `${(100 / itemCount) - 20}%`
    } else {
        newDiv.style.width = `${(100 / itemCount) - 5}%`
    }
    showProgressContainer.appendChild(newDiv);
}

let mainFormList = modalSection.querySelectorAll(".main");
let progressContainerList = modalSection.querySelectorAll(".progress-container");

var nextClicked = formSelected.querySelectorAll(".next_button");
nextClicked.forEach((nextClicked_form) => {
    nextClicked_form.addEventListener('click', (event) => {
        event.preventDefault();
        if (!nextClicked_validateform()) {
            return false
        }
        currrentFormNumber++;
        updateform();
        progress_forward();
    });
});

var backClicked = formSelected.querySelectorAll(".back_button");
backClicked.forEach((backClicked_form) => {
    backClicked_form.addEventListener('click', (event) => {
        event.preventDefault();
        currrentFormNumber--;
        updateform();
        progress_backward();
    });
});

// let resetClicked = formSelected.querySelector(".register-modal .danger_button");
// resetClicked.addEventListener('click', function (event) {
//     event.preventDefault();
//     resetActiveFields();
// });


let submitClicked = formSelected.querySelectorAll(".submit_button");

const formCheckmark = modalSection.querySelector('#form_checkmark');
const dataTable = document.querySelector('#dataTable thead tr');
const formCrossmark = modalSection.querySelector('#form_crossmark');
const formFinalMessage = modalSection.querySelector('#form_final_message');
const modalTitle = modalSection.querySelector('h5');
let editSubmit = false
let urlEdit = "{{config('config.routes.organizationUpdate')}}";

function isEdit(editStatus = false, rowCell = null) {
    titleRest = modalTitle.innerText.split(' ').slice(1,).join(' ')

    if (editStatus) {
        modalTitle.innerText = 'Edit ' + titleRest
        editSubmit = true
        urlEdit = rowCell.getAttribute("href");
        if (rowCell != null) {
            row = rowCell.parentElement.parentElement;
            let dataList = [];
            [...row.children].map(data => {
                if (data.innerHTML == data.innerText) {
                    dataList.push(data.innerHTML);
                }
            })
            console.log(dataList) //to be filled on the form
        }
    }
    else {
        if (rowCell == 'blacklist') {
            modalTitle.innerText = 'Blacklisting ' + titleRest
        } else {
            modalTitle.innerText = 'Create ' + titleRest
        }
        editSubmit = false
    }

}

submitClicked.forEach(function (submitClicked_form) {
    submitClicked_form.addEventListener('click', (event) => {
        event.preventDefault();
        if (!nextClicked_validateform()) {
            return false
        }

        let url = submitClicked_form.getAttribute("href");
        let type = 'POST';
        let formData = new FormData(formSelected);
        //let org_id = $('#org_id').val();
        if (editSubmit) {
            url = urlEdit //+ org_id;
            formData.append("_method", "PATCH");
        }

        $.ajax({
            url: url,
            type: type,
            contentType: false,
            processData: false,
            async: false,
            cache: false,
            timeout: 30000,
            data: formData,
            headers: {
                "Authorization": "Bearer " + "{{session('access_token')}}",
            },
        })
            .done((data, textStatus, jqXHR) => {
                if (data.error === 0) {
                    console.log('success ' + modalTitle.innerText)
                    formCheckmark.hidden = false;
                    formCrossmark.hidden = true;
                    formFinalMessage.innerHTML = `<h4>{{__('common.success')}}</h4>`;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    $('#datatable').DataTable().ajax.reload();
                    progressContainerList[currrentFormNumber].classList.add('success');
                } else {
                    console.log('form-error ' + modalTitle.innerText)
                    if (data.inner != undefined) {
                        message = data.inner.messages
                    } else {
                        message = modalTitle.innerText + " Unsuccessful!"
                    }
                    formCheckmark.hidden = true;
                    formCrossmark.hidden = false;
                    formFinalMessage.innerHTML = `<h4>${message}</h4>`;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    progressContainerList.forEach((progressContainer) => {
                        progressContainer.classList.remove('success');
                        progressContainer.classList.add('failed');
                    })
                }
            })
            .fail((xhr, textStatus, errorThrown) => {
                console.log('backend-error ' + modalTitle.innerText)

                formCheckmark.hidden = true;
                formCrossmark.hidden = false;
                //let errors = xhr.responseJSON.inner.validation;
                // $.each(errors, function (key, value) {
                //     $("[name='" + key + "']").after('<div class="text-danger error-txt"> ' + value + ' </div>');
                //     $("[name='" + key + "']").addClass('is-invalid');
                // });
                //let error_msg = xhr.responseJSON.inner.message;
                let error_msg = '';
                if (error_msg != '') {
                    message = error_msg
                }
                else {
                    message = "Operation Unsuccessful!"
                }
                formFinalMessage.innerHTML = `<h4>${message}</h4>`;
                window.scrollTo({ top: 0, behavior: 'smooth' });
                progressContainerList.forEach((progressContainer) => {
                    progressContainer.classList.remove('success');
                    progressContainer.classList.add('failed');
                })
            })

        formSelected.classList.remove('flex-grow-1');
        currrentFormNumber++;
        updateform();
        stepList.forEach(list => {
            list.classList.remove('active-view');
        });
    });
});


const inputsAndSelects = formSelected.querySelectorAll('.main input, .main select');
const gileGalleries = formSelected.querySelectorAll(' .main .upload_gallery');

function resetAllFields() {
    inputsAndSelects.forEach((element) => {
        if (element.type === 'checkbox' || element.type === 'radio') {
            element.checked = false;
            element.classList.remove('is-valid');
            element.classList.remove('is-invalid');
        } else {
            if (!element.hasAttribute('readonly')) {
                element.value = '';
                element.classList.remove('is-valid');
                element.classList.remove('is-invalid');
            }
        }
    });
    gileGalleries.forEach(gallery => {
        gallery.innerHTML = '';
    });
    formSelected.classList.add('flex-grow-1');
}


function resetActiveFields() {
    let inputsAndSelectsActive = formSelected.querySelectorAll('.main.active-view input,.main.active-view select,.main.active-view td, .main.active-view div.upload_gallery');
    inputsAndSelectsActive.forEach((element) => {
        if (element.type === 'checkbox' || element.type === 'radio') {
            element.checked = false;
            element.classList.remove('is-valid');
            element.classList.remove('is-invalid');
        } else {
            if (!element.hasAttribute('readonly')) {
                element.value = '';
                element.classList.remove('is-valid');
                element.classList.remove('is-invalid');
            }
            else if (element.hasAttribute('contenteditable')) {
                element.innerHTML = '';
            }
        }
    });
    let gileGalleriesActive = formSelected.querySelectorAll(' .main.active-view .upload_gallery');
    gileGalleriesActive.forEach(gallery => {
        gallery.innerHTML = '';
    });
}

var modalClosedBtns = document.querySelectorAll(".register-modal .buttons button.warning_button[data-bs-dismiss='modal'],.form-container button.btn-close[data-bs-dismiss='modal']");
modalClosedBtns.forEach((modalClosedBtn) => {
    modalClosedBtn.addEventListener('click', (event) => {
        closedModel(event)
    });
});



var popoverTriggerList = [].slice.call(formSelected.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map((popoverTriggerEl) => {
    return new bootstrap.Popover(popoverTriggerEl)
})

function updateform() {
    mainFormList.forEach(function (mainFormCurrent) {
        mainFormCurrent.classList.remove('active-view');
    })
    mainFormList[currrentFormNumber].classList.add('active-view');
}

function progress_forward() {
    stepList.forEach(list => {
        list.classList.remove('active-view');
    });
    stepList[currrentFormNumber].classList.add('active-view');
    progressContainerList[currrentFormNumber - 1].classList.add('success');
}

function progress_backward() {
    var nextFormNumber = currrentFormNumber + 1;
    stepList[currrentFormNumber].classList.add('active-view');
    progressContainerList[currrentFormNumber].classList.remove('success');
    if (stepList[nextFormNumber] != undefined) {
        stepList[nextFormNumber].classList.remove('active-view');
    }
}


function nextClicked_validateform() {
    validate = true;
    const activeMain = formSelected.querySelector(' .main.active-view')
    const activeInputsAndSelects = activeMain.querySelectorAll('input, select')
    activeInputsAndSelects.forEach((vaildatingInput) => {
        vaildatingInput.classList.remove('is-invalid');
        if (vaildatingInput.hasAttribute('required')) {
            if (vaildatingInput.value.length == 0) {
                validate = false;
                vaildatingInput.classList.add('is-invalid');
            }
        }
    });
    return validate;
}

function closedModel(event) {
    event.preventDefault();
    setTimeout(() => {
        resetAllFields();
        stepList.forEach(list => {
            list.classList.remove('active-view');
        });
        currrentFormNumber = 0;
        updateform();
        stepList[currrentFormNumber].classList.add('active-view');
        progressContainerList.forEach((progressContainer) => {
            progressContainer.classList.remove('success');
            progressContainer.classList.remove('failed');
        })
    }, 300)
}

inputsAndSelects.forEach((validatingInput) => {
    validatingInput.addEventListener('blur', function () {
        this.classList.remove('is-invalid');
        if (this.hasAttribute('required')) {
            if (this.value.length === 0) {
                validate = false;
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            } else {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            }
        }
    });
});

const selects = document.querySelectorAll("select");
selects.forEach((select) => {
    if (select.value != '') {
        select.classList.add('form-select-valid');
    }
    else {
        select.classList.remove('form-select-valid');
    }
    select.addEventListener('click', function () {
        if (this.value != '') {
            this.classList.add('form-select-valid');
        }
        else {
            this.classList.remove('form-select-valid');
        }
    });
});

function addRow(button) {
    const table = button.previousElementSibling.querySelector('table');
    const headerRow = table.querySelector('thead tr');
    const numOfCells = headerRow.children.length;
    const newRow = table.querySelector('tbody').insertRow(-1); // -1 appends the row at the end
    newRow.style.maxHeight = '40px';
    for (let i = 0; i < numOfCells; i++) {
        const cell = newRow.insertCell(i);
        cell.contentEditable = true;
    }
}

function removeRow(button) {
    const table = button.previousElementSibling.querySelector('table');
    table.querySelector('tbody').deleteRow(-1);
}

$(document).on('click', '#reset_btn', () => { $('#resetModal').modal('show'); });

$(document).on('click', '#addTCE_btn', () => { $('#TECmodal').modal('show'); });


$(document).ready(function () {
    if ($('#dataTable').length != 0) {
        let table = $('#dataTable').DataTable({
            "columnDefs": [
                { "targets": 'nosort', "orderable": false }
            ]
        });
        $('.dataTables_filter').css({
            'display': 'none'
        });
        $('#filterInfo').on('keyup', function () {
            table.search(this.value).draw();
        });
    }

});

const transfer_radio = document.querySelectorAll('input[name="transfer_radio"]');
if (transfer_radio) {
    transfer_radio.forEach((radioButton) => {
        radioButton.addEventListener("click", () => {
            if (radioButton.value == 'hide') {
                $('#transfer_file_dropzone').hide();
                $('#transfer_file_whitespace').show()
            }
            else {
                $('#transfer_file_whitespace').hide()
                $('#transfer_file_dropzone').show();

            }
        });
    })
}

const blacklist_radio = document.querySelectorAll('input[name="blacklist_radio"]');
if (blacklist_radio) {
    blacklist_radio.forEach((radioButton) => {
        radioButton.addEventListener("change", () => {
            if (radioButton.value != 'show') {
                $('#organization_procuring_entity_filter').hide();
                $('#blacklist_whitespace').show()
            }
            else {
                $('#organization_procuring_entity_filter').show();
                $('#blacklist_whitespace').hide()
            }
        });
    })
}

const menuContainer = document.querySelector(".bg-eGP.navbar ul.eGP-menu");
if (menuContainer) {
    menuContainer.addEventListener("wheel", function (e) {
        if (e.deltaY > 0) {
            menuContainer.scrollLeft += 100;
            e.preventDefault();
        }
        else {
            menuContainer.scrollLeft -= 100;
            e.preventDefault();
        }
    });
}



(function () {
    let lightSwitch = document.getElementById('lightSwitch');
    if (!lightSwitch) {
        return;
    }

    function onToggleMode() {
        if (lightSwitch.checked) {
            document.documentElement.setAttribute('data-bs-theme', 'dark')
            document.documentElement.classList.add('dark-mode')
        } else {
            document.documentElement.setAttribute('data-bs-theme', 'light')
            document.documentElement.classList.remove('dark-mode')
        }
    }

    function getSystemDefaultTheme() {
        const darkThemeMq = window.matchMedia('(prefers-color-scheme: dark)');
        if (darkThemeMq.matches) {
            return 'dark';
        }
        return 'light';
    }

    function setup() {
        settings = getSystemDefaultTheme();

        if (settings == 'dark') {
            lightSwitch.checked = true;
        }

        lightSwitch.addEventListener('change', onToggleMode);
        onToggleMode();
    }

    setup();
})();

<div wire:ignore.self>

    @if($currentPage == PAGECREATEFORM)
    @include("livewire.modules.administrations.niveauxscolaires.create")
    @endif

    @if($currentPage == PAGEEDITFORM)
    @include("livewire.modules.administrations.niveauxscolaires.edit")
    @endif

    @if($currentPage == PAGELIST)
    @include("livewire.modules.administrations.niveauxscolaires.liste")
    @endif

</div>

<script>
    window.addEventListener("showSuccessMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title: event.detail.message || "Opération effectuée avec succès!",
                showConfirmButton: false,
                timer: 5000
                }
            )
    })
</script>

<script>
    window.addEventListener("showErrorMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'warning',
                toast:true,
                title: event.detail.message || "Opération effectuée avec succès!",
                showConfirmButton: false,
                timer: 5000
                }
            )
    })
</script>

<script>
    window.addEventListener("showConfirmMessage", event=>{
       Swal.fire({
        title: event.detail.message.title,
        text: event.detail.message.text,
        icon: event.detail.message.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuer',
        cancelButtonText: 'Annuler'
        }).then((result) => {
        if (result.isConfirmed) {
            if(event.detail.message.data){
                @this.deleteNvScolaire(event.detail.message.data.data_id)
            }
        }
        })
    })

</script>
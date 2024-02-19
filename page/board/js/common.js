let reply_mod_btn = document.querySelectorAll('.reply .edit');
let reply_del_btn = document.querySelectorAll('.reply .del');

for(let rmb of reply_mod_btn){
  rmb.addEventListener('click',(e)=>{
    let target = e.target.closest('.reply').querySelector('.edit_dialog');
    let closeBtn = target.querySelector('button:last-of-type');
    target.setAttribute('open','open');
    
    closeBtn.addEventListener('click',()=>{
      target.removeAttribute('open');
    })
  })
}
for(let rdb of reply_del_btn){
  rdb.addEventListener('click',(e)=>{
    let target = e.target.closest('.reply').querySelector('.del_dialog');
    let closeBtn = target.querySelector('button:last-of-type');
    target.setAttribute('open','open');
    
    closeBtn.addEventListener('click',()=>{
      target.removeAttribute('open');
    })
  })
}

//삭제버튼을 클릭하면 할일

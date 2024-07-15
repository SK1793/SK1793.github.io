import puppeteer from "puppeteer";

const getSearchList=async(string name)=>{

    //Init a Browser object
     // Start a Puppeteer session with:
    // - a visible browser (`headless: false` - easier to debug because you'll see the browser in action)
 
    const browser=puppeteer.launch({
        headless:false,
        defaultViewport:null
    })

    //New Page in Browser
    const page=(await browser).newPage();

    await (await page).goto("https://www.imdb.com/find/?q="+name+"&s=t",{
        waitUntil:"networkidle0"
    });
    // await page.waitForSelector('.popular-celebrities-item-card');

//queries

const item=await (await page).evaluate(()=>{

        // const artist_=document.querySelector("div > .sc-b1bb6a46-1");
        // const artist=document.getElementsByClassName(".popular-celebrities-item-card");
        // const artist_link=artist.getElementsByClassName(".popular-celebrity-card");

        const container_=document.querySelectorAll('.find-title-result');
       
        const name=document.querySelector(".popular-celebrity-name-text");
        
        var count =container_.length;
        console.log("length:"+count);
        console.log("title:"+name);
   
        //mutiple number of Pictures
        // const artist_Picture=artist_Url.document.querySelector("div.ipc-avatar--baseAlt  img.ipc-image");
        // let src = [];
        // for (let i = 0; i < artist_Picture.length; i++) {
        //    src.push(img[i].getAttribute("src"));
        // }
        // console.log("Images: "+src);

        return Array.from(container_).map((item) => 
            {
        let title_obj=item.querySelector(".ipc-metadata-list-summary-item__c .ipc-metadata-list-summary-item__tc a.ipc-metadata-list-summary-item__t");
        let year_obj=item.querySelector(".ipc-metadata-list-summary-item__c .ipc-metadata-list-summary-item__tc ul.ipc-metadata-list-summary-item__tl .ipc-metadata-list-summary-item__li");
        let actor_obj=item.querySelector(".ipc-metadata-list-summary-item__c .ipc-metadata-list-summary-item__tc ul.ipc-metadata-list-summary-item__stl .ipc-metadata-list-summary-item__li");

        const link_=title_obj.getAttribute("href")?title_obj.getAttribute("href"):"NA";
        var Imdb_id=[];
            if(link_!="NA"){
                const Imdb_id_splitter=link_.substring(7)
                Imdb_id=Imdb_id_splitter.split('/')[0]?Imdb_id_splitter.split('/')[0]:"NA";
            }

        console.log("IMdb_Id: "+Imdb_id);

        const title=title_obj.innerHTML?title_obj.innerHTML:"NA";
        const year=year_obj.innerHTML?year_obj.innerHTML:"NA";
        const actor=actor_obj.innerHTML?actor_obj.innerHTML:"NA";
        
        let image=item.querySelector(".sc-daafffbc-0 .ipc-media img.ipc-image");
        const image_alt=image.getAttribute("alt");
        const image_url=image.getAttribute("src");
        const contents={Imdb_id,link_,title,year,actor,image_alt,image_url};

        // console.log({link_,count,title,year,actor});
            
        return {count,contents};

        });
    });

    console.log(item);

    (await browser).close;
};


getSearchList("Mission");

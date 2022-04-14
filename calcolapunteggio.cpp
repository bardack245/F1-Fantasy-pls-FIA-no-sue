#include <iostream>

using namespace std;

int qual[21] = {0, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0};
int fin[21] = {0, 25, 18, 15, 12, 10, 8, 6, 4, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0};

int punteggio (int q, int f, bool comp){
    int tmp;
    tmp=q-f;
    tmp=tmp*2;
    tmp+=fin[f];
    tmp+=qual[q];
    if (comp==1){
        tmp+=3;
    }

    return tmp;
}

float variazione(int punteggio, int punteggioprec, float valprec){
    float var;
    int tmp;
    tmp=(punteggio-punteggioprec);
    var= tmp/10;
    var*=0.1;
    valprec+=var;
    return valprec;
}


int main(){
   
    int punteggioprec=0;
    float valprec;

    cin>>valprec;

   while(true){
    
        int f;
        int q;
        bool comp;
        int tmp;
        float val;

        cin>>q;
        cin>>f;
        cin>> comp;

        if(q==99){
            break;
        }

        tmp= punteggio(q, f, comp);

        cout<<"\n\nIl punteggio e\': "<<tmp<<"\n";

        val=variazione(tmp, punteggioprec, valprec);

        cout<<"Il valore è e\': "<<val<<"\n\n\n\n";

        punteggioprec=tmp;
        valprec=val;
    }

    return 0;
}
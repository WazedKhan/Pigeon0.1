import sys
import os
import joblib
if len(sys.argv) > 1:
    ex1 = sys.argv[1]



ex1=ex1.replace('_',' ')
print(ex1)
loc = str(os.getcwd())+ ("\python\matha.pkl")
model = joblib.load(loc)
result = model.predict([ex1])
result = ''.join(map(str, result))


print(result,end="")


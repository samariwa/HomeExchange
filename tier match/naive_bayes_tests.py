# Testing
if __name__ == "__main__":
    # Imports
    import numpy as np
    from sklearn.model_selection import train_test_split
    from sklearn.feature_extraction.text import CountVectorizer
    from sklearn.naive_bayes import MultinomialNB
    from sklearn.preprocessing import LabelEncoder
    from sklearn.metrics import accuracy_score, confusion_matrix
    from sklearn import datasets
    import pandas as pd

    from naive_bayes import NaiveBayes

    data = pd.read_csv('/Users/Mariwa/OneDrive/Documents/tier_dataset.csv')
    def accuracy(y_true, y_pred):
        accuracy = np.sum(y_true == y_pred) / len(y_true)
        return accuracy


    #X, y = datasets.make_classification(n_samples=1000, n_features=10, n_classes=2, random_state=123)
    X,Y  = data.Bedrooms, data.Tier
    x_train, x_test, y_train, y_test = train_test_split(X, Y, test_size=1, random_state=41)

    vectorizer = CountVectorizer()
    count = vectorizer.fit_transform(x_train.values)
    clf = MultinomialNB()
    targets = y_train.values
    clf.fit(count, targets)
    y_pred = clf.predict(vectorizer.transform(x_test))
    confusion_matrix(y_test, y_pred)
    
    print(accuracy_score(y_test, y_pred))
    
   # nb = NaiveBayes()
   # nb.fit(X_train, y_train)
   # predictions = nb.predict(X_test)

    #print("Naive Bayes classification accuracy", accuracy(y_test, predictions))